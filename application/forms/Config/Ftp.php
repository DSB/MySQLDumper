<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      Forms_Config
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Create form to input ftp data on configuration screen
 *
 * @package         MySQLDumper
 * @subpackage      Forms_Config
 */
class Application_Form_Config_Ftp extends Zend_Form_SubForm
{
    /**
     * Msd Translator
     * @var Msd_Language
     */
    protected $_lang;
    /**
     * Init form and add all elements
     *
     * @return void
     */
    public function init()
    {
        $config = Msd_Configuration::getInstance();
        $this->_lang = Msd_Language::getInstance();
        $this->setDisableLoadDefaultDecorators(true);
        $this->setDecorators(array('SubForm'));
        $this->addDisplayGroupPrefixPath(
            'Msd_Form_Decorator',
            'Msd/Form/Decorator/'
        );
        $this->setDisplayGroupDecorators(array('DisplayGroup'));
        $this->_addButtonFtpAdd();

        $ftpConfig = $config->get('config.ftp');
        $ftpKeys = array_keys($ftpConfig);
        foreach ($ftpKeys as $ftpConnectionId) {
            $this->_addRadioActivated($ftpConnectionId);
            $this->_addInputTimeout($ftpConnectionId);
            $this->_addCheckboxPassiveMode($ftpConnectionId);
            $this->_addCheckboxSsl($ftpConnectionId);
            $this->_addInputServerAndPort($ftpConnectionId);
            $this->_addInputUserAndPass($ftpConnectionId);
            $this->_addInputPath($ftpConnectionId);
            $this->_addButtonsTestAndDelete($ftpConnectionId);

            $legend = $this->_lang->getTranslator()->_('L_FTP_CONNECTION')
                . ' ' . ($ftpConnectionId + 1);
            $this->addDisplayGroup(
                array(
                    'ftp_' . $ftpConnectionId . '_use',
                    'ftp_' . $ftpConnectionId . '_timeout',
                    'ftp_' . $ftpConnectionId . '_passiveMode',
                    'ftp_' . $ftpConnectionId . '_ssl',
                    'ftp_' . $ftpConnectionId . '_server',
                    'ftp_' . $ftpConnectionId . '_port',
                    'ftp_' . $ftpConnectionId . '_user',
                    'ftp_' . $ftpConnectionId . '_pass',
                    'ftp_' . $ftpConnectionId . '_dir',
                    'ftpCheck' . $ftpConnectionId,
                    'ftpDelete' . $ftpConnectionId,
                ),
                'ftp' . $ftpConnectionId,
                array(
                    'disableLoadDefaultDecorators' => true,
                    'decorators' => array('DisplayGroup'),
                    'legend' => $legend,
                )
            );
        }
    }

    /**
     * Add button "Add ftp connection"
     *
     * @return void
     */
    private function _addButtonFtpAdd()
    {
        $this->addElement(
            'button',
            'headElement',
            array(
                'disableLoadDefaultDecorators' => true,
                'content' =>
                    $this->getView()->getIcon('plus') . ' ' .
                    $this->_lang->getTranslator()->_('L_FTP_ADD_CONNECTION'),
                'decorators' => array('Default'),
                'escape' => false,
                'label' => '',
                'class' => 'Formbutton',
                'onclick' => "addFtpConnection();",
            )
        );
    }

    /**
     * Add radio "ftp activated"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addRadioActivated($index)
    {
        $this->addElement(
            'radio',
            'ftp_' . $index . '_use',
            array(
                'class' => 'radio toggler',
                'label' => 'L_FTP_TRANSFER',
                'onclick' => "myToggle(this, 'y', 'ftpToggle" . $index . "');",
                'listsep' => ' ',
                'disableLoadDefaultDecorators' => true,
                'multiOptions' => array(
                    'y' => 'L_ACTIVATED',
                    'n' => 'L_NOT_ACTIVATED',
                ),
                'decorators' => array('Default'),
            )
        );
    }

    /**
     * Add input "ftp timeout"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addInputTimeout($index)
    {
        $this->addElement(
            'text',
            'ftp_' . $index . '_timeout',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_FTP_TIMEOUT',
                'secondLabel' => 'L_SECONDS',
                'disableLoadDefaultDecorators' => true,
                'size' => 3,
                'maxlength' => 3,
                'decorators' => array('DoubleLabel'),
                'validators' => array('Digits'),
            )
        );
    }

    /**
     * Add checkbox "passive mode"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addCheckboxPassiveMode($index)
    {
        $this->addElement(
            'checkbox',
            'ftp_' . $index . '_passiveMode',
            array(
                'class' => 'checkbox ftpToggle' . $index,
                'label' => 'L_FTP_CHOOSE_MODE',
                'secondLabel' => 'L_FTP_PASSIVE',
                'disableLoadDefaultDecorators' => true,
                'checkedValue' => 'y',
                'uncheckedValue' => 'n',
                'decorators' => array('DoubleLabel'),
            )
        );
    }

    /**
     * Add checkbox "ssl"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addCheckboxSsl($index)
    {
        $this->addElement(
            'checkbox',
            'ftp_' . $index . '_ssl',
            array(
                'class' => 'checkbox ftpToggle' . $index,
                'label' => 'L_FTP_SSL',
                'secondLabel' => 'L_FTP_USESSL',
                'disableLoadDefaultDecorators' => true,
                'checkedValue' => 'y',
                'uncheckedValue' => 'n',
                'decorators' => array('DoubleLabel'),
            )
        );
    }

    /**
     * Add input "server"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addInputServerAndPort($index)
    {
        $this->addElement(
            'text',
            'ftp_' . $index . '_server',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_FTP_SERVER',
                'disableLoadDefaultDecorators' => true,
                'decorators' => array('Default'),
            )
        );

        $this->addElement(
            'text',
            'ftp_' . $index . '_port',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_FTP_PORT',
                'disableLoadDefaultDecorators' => true,
                'size' => 4,
                'maxlength' => 5,
                'validators' => array('Digits'),
                'decorators' => array('Default'),
            )
        );
    }
        /**
     * Add input "user"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addInputUserAndPass($index)
    {
        $this->addElement(
            'text',
            'ftp_' . $index . '_user',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_FTP_USER',
                'disableLoadDefaultDecorators' => true,
                'size' => 60,
                'decorators' => array('Default'),
            )
        );

        $this->addElement(
            'password',
            'ftp_' . $index . '_pass',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_FTP_PASS',
                'disableLoadDefaultDecorators' => true,
                'size' => 60,
                'decorators' => array('Default'),
                'renderPassword' => true,
            )
        );
    }

    /**
     * Add input server
     *
     * @param int $index
     *
     * @return void
     */
    private function _addInputPath($index)
    {
        $this->addElement(
            'text',
            'ftp_' . $index . '_dir',
            array(
                'class' => 'text ftpToggle' . $index,
                'label' => 'L_DIR',
                'disableLoadDefaultDecorators' => true,
                'size' => 60,
                'decorators' => array('Default'),
            )
        );
    }

    /**
     * Add Button "Test connection"
     *
     * @param int $index
     *
     * @return void
     */
    private function _addButtonsTestAndDelete($index)
    {
        $this->addElement(
            'button',
            'ftpCheck' . $index,
            array(
                'disableLoadDefaultDecorators' => true,
                'content' =>
                    $this->getView()->getIcon('Connect', '', 16) . ' ' .
                    $this->_lang->getTranslator()->_('L_TESTCONNECTION'),
                'decorators' => array('LineStart'),
                'escape' => false,
                'label' => '',
                'class' => 'Formbutton ftpToggle' . $index,
                'onclick' => "alert('checkConnection(" .
                    $index . ")');",
            )
        );

        if ($index > 0) {
            $this->addElement(
                'button',
                'ftpDelete' . $index,
                array(
                    'disableLoadDefaultDecorators' => true,
                    'content' =>
                        $this->getView()->getIcon('delete') . ' ' .
                        $this->_lang->getTranslator()->_('L_FTP_CONNECTION_DELETE'),
                    'decorators' => array('LineEnd'),
                    'escape' => false,
                    'label' => '',
                    'class' => 'Formbutton',
                    'onclick' => "deleteFtpConnection(" .
                        $index . ");",
                )
            );
        }
    }

    /**
     * Get valid values
     *
     * @param array $data
     *
     * @return array
     */
    public function getValidValues($data)
    {
        $values = parent::getValidValues($data, true);
        while (false !== (list($key, $value) = each($values))) {
            if (substr($key, 0, 4) != 'ftp_') {
                continue;
            }
            list(, $ftpId, $ftpKey) = explode('_', $key);
            if (!isset($values[$ftpId])) {
                $values[$ftpId] = array();
            }
            $values[$ftpId][$ftpKey] = $value;
            unset($values[$key]);
        }
        return $values;
    }

    /**
     * Set default values
     *
     * @param array $defaults
     *
     * @return Zend_Form
     */
    public function setDefaults($defaults)
    {
        if (!empty($defaults['ftp'])) {
            $ftp = array();
            while (
                false !== (list($ftpId, $ftpData) = each($defaults['ftp']))
            ) {
                foreach ($ftpData as $ftpKey => $ftpValue) {
                    $ftp['ftp_' . $ftpId . '_' . $ftpKey] = $ftpValue;
                }
            }
            $defaults['ftp'] = $ftp;
        }
        return parent::setDefaults($defaults);
    }

    /**
     * Set input default value
     *
     * @param string $name
     * @param string $value
     */
    public function setDefault($name, $value)
    {
        $name = 'ftp_'.str_replace('.', '_', $name);
        parent::setDefault($name, $value);
    }
}
