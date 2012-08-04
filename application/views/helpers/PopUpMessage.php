<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 * @version         SVN: $Rev$
 * @author          $Author$
 */

/**
 * Displayment of messages
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_PopUpMessage extends Zend_View_Helper_Abstract
{
    /**
     * Stores the information about the messages to display.
     *
     * @var array
     */
    private $_messages = array();

    /**
     * Mapping of Msd_Config position to jquery ui param
     *
     * @var array
     */
    private $_positions = array(
        'topLeft'      => array('left','top'),
        'topCenter'    => array('center','top'),
        'topRight'     => array('right','top'),
        'middleLeft'   => array('left','center'),
        'middleCenter' => array('center','center'),
        'middleRight'   => array('right','center'),
        'bottomLeft'   => array('left','bottom'),
        'bottomCenter' => array('center','bottom'),
        'bottomRight'  => array('right','bottom'),
    );

    /**
     * returns the instance of this view helper.
     *
     * @return Zend_View_Helper_PopUpMessage
     */
    public function popUpMessage()
    {
        return $this;
    }

    /**
     * Adds a new message to the stack.
     *
     * @param string       $messageId Dom-Id of the dialog
     * @param string       $title     Title for the dialog
     * @param string|array $message   Message to display
     * @param array        $options   Additional options for the dialog box
     *
     * @return void
     */
    public function addMessage($messageId, $title, $message, $options = array())
    {
        $lang = Msd_Language::getInstance();
        $translator = $lang->getTranslator();
        $optionKeys = array_keys($options);
        if (!in_array('buttons', $optionKeys)) {
            $options['buttons'] = array(
                'L_OK' => 'function() {$(this).dialog(\'close\');}'
            );
        }
        $translatedButtons = array();
        foreach ($options['buttons'] as $key => $value) {
            $translatedButtons[ucfirst($translator->_($key))] = $value;
        }
        $options['buttons'] = $translatedButtons;
        if (!in_array('dialogClass', $optionKeys)) {
            $options['dialogClass'] = 'info';
        }
        if (!in_array('position', $optionKeys)) {
            $options['position'] = $this->_getDefaultPosition();
        }
        $options['title'] = $translator->_($title);
        if (!empty($message)) {
            if (is_array($message)) {
                $message[0] = $translator->_($message[0]);
                $message = call_user_func_array('sprintf', $message);
            } else {
                $message = $translator->_($message);
            }
        }
        $this->_messages[$messageId] = array(
            'message' => $message,
            'params' => $options,
            'attribs' => array(
                'id' => $messageId,
            ),
        );
    }

    /**
     * Renders the dialogs.
     *
     * Add "OnLoad" scripts to jQuery and create the HTML-Output.
     *
     * @return string
     */
    public function __toString()
    {
        $messages = array();
        foreach ($this->_messages as $messageInfo) {
            $html = '<div class="nodisplay"';
            foreach ($messageInfo['attribs'] as $attribName => $attribValue) {
                $html .= ' ' . $attribName . '="' . $attribValue . '"';
            }
            $html .= '>' . $messageInfo['message'] . '</div>';
            $javascript = sprintf(
                '%s(\'#%s\').dialog(%s);',
                ZendX_JQuery_View_Helper_JQuery::getJQueryHandler(),
                $messageInfo['attribs']['id'],
                $this->_renderOptions($messageInfo['params'])
            );
            $this->view->jQuery()->addOnLoad($javascript);
            $messages[] = $html;
        }
        return implode("\n", $messages);
    }

    /**
     * Render the dialog options.
     *
     * This will return modified but valid JSON.
     *
     * @param array $options Dialog options
     *
     * @return string
     */
    private function _renderOptions($options)
    {
        $json = '{';
        $opts = array();
        foreach ($options as $key => $value) {
            $jsonOpt = $key . ': ';
            if (is_array($value)) {
                $jsonOpt .= $this->_renderOptions($value);
            } elseif (is_bool($value)) {
                $jsonOpt .= $value === true ? 'true':'false';
            } elseif (
                is_numeric($value) || strpos($value, 'function') !== false
            ) {
                $jsonOpt .= $value;
            } else {
                $jsonOpt .= '"' . $value . '"';
            }
            $opts[] = $jsonOpt;
        }
        $json .= implode(',', $opts) . '}';
        return $json;
    }

    /**
     * Get position of notification window from config and mapt to jQueryUi
     *
     * @return array Array containing jQuerUi-params
     */
    private function _getDefaultPosition()
    {
        $position = $this->view->config->getParam('interface.notificationWindowPosition');
        if (isset($this->_positions[$position])) {
            $position = $this->_positions[$position];
        }
        return $position;
    }
}

