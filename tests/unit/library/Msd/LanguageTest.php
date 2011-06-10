<?php
/**
 * @group language
 */
class Msd_LanguageTest extends ControllerTestCase
{
    private $_lang = null;
    private $_translator = null;
    private $_languages = array();

    public function setUp()
    {
        $this->_lang = Msd_Language::getInstance();
        $this->_translator = $this->_lang->getTranslator();
        $this->_languages = $this->_lang->getAvailableLanguages();
    }

    public function testCanGetInstance()
    {
        $this->assertInstanceOf('Msd_Language', $this->_lang);
    }

    public function testCanGetTranslator()
    {
        $this->assertInstanceOf('Zend_Translate', $this->_translator);
    }

    public function testCanLoadLanguageEn()
    {
        $this->_lang->loadLanguage('en');
        $this->assertEquals('yes', $this->_translator->translate('L_YES'));
    }

    public function testCanLoadLanguageDe()
    {
        $this->_lang->loadLanguage('de');
        $this->assertEquals('ja', $this->_translator->translate('L_YES'));
    }

    public function testCanLoadAndTranslateAllLanguageFiles()
    {
        $languages = array_keys($this->_languages);
        foreach ($languages as $language) {
            $this->_lang->loadLanguage($language);
            $this->assertNotEquals(
                'L_YES',
                $this->_translator->translate('L_YES')
            );
        }
    }

    public function testCanUseMagicGetter()
    {
        $this->_lang->loadLanguage('de');
        $this->assertEquals('ja', $this->_lang->L_YES);
    }

    public function testCanLoadLanguageList()
    {
        $isArray = is_array($this->_languages);
        $this->assertEquals(true, $isArray);
    }

    public function testLanguageKeyExists()
    {
        $languages = array('ar', 'bg_BG', 'cs', 'da', 'de', 'de_CH', 'de_LU',
                           'el', 'en', 'es', 'fa', 'fr', 'it', 'nl', 'pl', 'pt_BR', 'ro', 'ru',
                           'sk', 'sl', 'sv_SE', 'tr', 'vi_VN'
        );
        foreach ($languages as $language) {
            $this->assertArrayHasKey($language, $this->_languages);
        }
    }

    public function testReturnsOriginalInputForUnsetValues()
    {
        $this->assertEquals(
            'No Translation',
            $this->_translator->translate('No Translation')
        );
    }

    public function testCanTranslateZendIds()
    {
        $this->_lang->loadLanguage("de");
        $zendmessageId = 'emailAddressInvalidFormat';
        $translation = $this->_lang->translateZendId($zendmessageId);
        $this->assertEquals(
            "Das Format der E-Mail-Adresse ist ungültig.",
            $translation
        );
    }

    public function testWontTranslateAlreadyTranslatedZendIds()
    {
        $this->_lang->loadLanguage("de");
        $zendmessageId = 'accessFilter';
        $translation = $this->_lang->translateZendId($zendmessageId, 'accessFilter');
        $this->assertEquals("accessFilter", $translation
        );
    }

    public function testReturnsUntranslatedStringWithoutPrefixIfMessageIsUnknown()
    {
        $this->_lang->loadLanguage("de");
        $res = $this->_lang->L_IDONTEXIST;
        $this->assertEquals("IDONTEXIST", $res);
    }

    public function testForbidsCloning()
    {
        try {
            clone($this->_lang);
        } catch (Msd_Exception $e) {
            $res = 'Cloning of Msd_Language is not allowed!';
            $this->assertEquals($res, $e->getMessage());
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }
}