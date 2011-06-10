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
 * Build a paginator.
 *
 * @package         MySQLDumper
 * @subpackage      View_Helpers
 */
class Msd_View_Helper_Paginator extends Zend_View_Helper_Abstract
{
    /**
     * Types for the buttons in the view script.
     * The type depends on the current mode.
     *
     * @var array
     */
    protected $_buttonTypes = array(
        'form' => 'submit',
        'js' => 'button',
        'url' => 'button',
    );

    /**
     * Defaults for the options. This array is used to fill missing options.
     *
     * @var array
     */
    protected $_defaults = array(
        'currentPage' => 1,
        'pageCount' => 1,
        'urlParam' => 'pageNr',
        'baseUrl' => '',
        'mode' => 'form',
        'actions' => array(
            'first' => '',
            'prev' => '',
            'next' => '',
            'last' => '',
            'change' => '',
        ),
        'method' => 'post',
        'enctype' => 'multipart/form-data',
    );

    /**
     * Builds a paginator depending on the given options.
     *
     * <code>
     * <?php
     * $options = array(
     *     'currentPage',       // Number of the currently selected page.
     *     'pageCount',         // Number of total pages.
     *     'urlParam',          // Name of the url parameter which gets the new selected page number.
     *     'baseUrl',           // Base URL for form action and buttons. urlParam and new page number will be appended.
     *     'mode',              // Mode, in which the paginator operates (can be "form", "url" or "js")
     *     'actions' => array(  // JS code for the buttons in "js" mode and JS code for the text input field.
     *         'first',         // The string ":PAGE:" will be replaced with the target page number.
     *         'prev',
     *         'next',
     *         'last',
     *         'change',        // If you want to call a JS function with the new page number as parameter
     *     ),                   // use "myFunc(this.value);".
     *     'method',            // Value for "method" HTML attribute of the "form" tag.
     *     'enctype',           // Value for "enctype" HTML attribute of the "form" tag.
     * );
     * ?>
     * <code>
     *
     * @param array $options Options for the paginator
     *
     * @return string HTML code for view script inclusion
     */
    public function paginator(array $options)
    {
        $view = clone $this->view;
        $view->clearVars();

        $options = array_merge($this->_defaults, $options);

        $buttons = $this->_getButtons($options);
        $onChange = $this->_getOnChange($options['mode'], $options['baseUrl'], $options['urlParam']);
        if ($options['mode'] == 'js') {
            $onChange = $this->_getOnChange($options['mode'], $options['actions']['change'], $options['urlParam']);
        }

        $viewData = array(
            'currentPage' => $options['currentPage'],
            'pageCount' => $options['pageCount'],
            'urlParam' => $options['urlParam'],
            'onChange' => $onChange,
            'buttonType' => $this->_buttonTypes[$options['mode']],
            'first' => $buttons['first'],
            'prev' => $buttons['prev'],
            'next' => $buttons['next'],
            'last' => $buttons['last'],
            'formEncType' => $options['enctype'],
            'formAction' => $options['baseUrl'],
            'formMethod' => $options['method'],
        );
        
        $view->assign($viewData);
        return $view->render('helper/paginator.phtml');
    }

    /**
     * Builds the information for the buttons (first page, previous page, next page and last page).
     *
     * @param array $options Button options
     *
     * @return array Information for the view script
     */
    protected function _getButtons(array $options)
    {
        $buttons = array();
        $buttons['first'] = $this->_getButtonInfo(
            (bool) ($options['currentPage'] <= 1)
        );
        $buttons['first']['icon'] = 'First' . $buttons['first']['icon'];
        $buttons['first']['click'] = $this->_getButtonClick(
            $options['mode'],
            array(
                'targetPage' => 1,
                'onClick'    => $options['actions']['first'],
                'baseUrl'    => $options['baseUrl'],
                'urlParam'   => $options['urlParam'],
            )
        );

        $buttons['prev'] = $this->_getButtonInfo(
            (bool) ($options['currentPage'] <= 1)
        );
        $buttons['prev']['icon'] = 'Back' . $buttons['prev']['icon'];
        $buttons['prev']['click'] = $this->_getButtonClick(
            $options['mode'],
            array(
                'targetPage' => $options['currentPage'] - 1,
                'onClick'    => $options['actions']['prev'],
                'baseUrl'    => $options['baseUrl'],
                'urlParam'   => $options['urlParam'],
            )
        );

        $buttons['next'] = $this->_getButtonInfo(
            (bool) ($options['currentPage'] >= $options['pageCount'])
        );
        $buttons['next']['icon'] = 'Forward' . $buttons['next']['icon'];
        $buttons['next']['click'] = $this->_getButtonClick(
            $options['mode'],
            array(
                'targetPage' => $options['currentPage'] + 1,
                'onClick'    => $options['actions']['next'],
                'baseUrl'    => $options['baseUrl'],
                'urlParam'   => $options['urlParam'],
            )
        );

        $buttons['last'] = $this->_getButtonInfo(
            (bool) ($options['currentPage'] >= $options['pageCount'])
        );
        $buttons['last']['icon'] = 'Last' . $buttons['last']['icon'];
        $buttons['last']['click'] = $this->_getButtonClick(
            $options['mode'],
            array(
                'targetPage' => $options['pageCount'],
                'onClick'    => $options['actions']['last'],
                'baseUrl'    => $options['baseUrl'],
                'urlParam'   => $options['urlParam'],
            )
        );

        return $buttons;
    }

    /**
     * Builds the basic info for a button (disabled status and disabled suffix for buttons icon)
     *
     * @param bool $disabled Status of the button
     *
     * @return array Basic info about the button
     */
    protected function _getButtonInfo($disabled)
    {
        return array(
            'disabled' => $disabled ? ' disabled="disabled"' : '',
            'icon' => $disabled ? 'Disabled' : '',
        );
    }

    /**
     * Builds the javascript code for the HTML attribute "onclick".
     *
     * @param string $mode    Current paginator mode (can be "form", "url" or "js")
     * @param array  $options Options for the "onclick" attribute
     *
     * @return string JS-Code for the "onclick" attribute
     */
    protected function _getButtonClick($mode, array $options)
    {
        $onClick = '';

        if ($mode == 'form') {
            $onClick = "$(this).parent().children('select').val(" . $options['targetPage'] . "); "
                . "$(this).parent().parent()[0].submit();";
        }

        if ($mode == 'url') {
            $onClick = "window.location.href = '" . rtrim($options['baseUrl'], '/')
                . "/{$options['urlParam']}/{$options['targetPage']}/';";
        }

        if ($mode == 'js') {
            $onClick = str_replace(':PAGE:', $options['targetPage'], $options['onClick']);
        }

        return $onClick;
    }

    /**
     * Builds the Javascript code for "onchange" HTML attribute.
     * This code is used for the combobox.
     *
     * @param string $mode     Current paginator mode (can be "form", "url" or "js")
     * @param string $baseUrl  Base URL or Javascript code for the event.
     * @param string $urlParam Name of the URL param. Its value will set to the entered page.
     *
     * @return string JS-Code for the "onchange" HTML attribute.
     */
    protected function _getOnChange($mode, $baseUrl = '', $urlParam = '')
    {
        $onChange = "";
        if ($mode == 'form') {
            $onChange = "$(this).parent().parent()[0].submit();";
        }

        if ($mode == 'url') {
            $onChange = "window.location.href = '" . rtrim($baseUrl, '/') . "/$urlParam/' + this.value + '/';";
        }

        if ($mode == 'js') {
            $onChange = "$baseUrl";
        }

        return $onChange;
    }
}
