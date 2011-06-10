<?php
/**
 * @group html
 */
class Msd_HtmlTest extends PHPUnit_Framework_TestCase
{
    public function testCanConvertNewLines()
    {
        $expected = 'alert("hello");\nalert("hello2");';
        $res = Msd_Html::getJsQuote("alert(\"hello\");\nalert(\"hello2\");", false);
        $this->assertEquals($expected, $res);
    }

    public function testCanBuildJsQuotedStringAndEscapesSlashes()
    {
        $expected = 'alert(\"hello\/\");';
        $res = Msd_Html::getJsQuote('alert("hello/");', true);
        $this->assertEquals($expected, $res);
    }

    public function testCanCreatePrefixArray()
    {
        $array = array(
                        'name_one'    => 1,
                        'name_two'    => 1,
                        'name_three'  => 1,
                        'name2_one'   => 1,
                        'name2_two'   => 1,
                        'name2_three' => 1,
                        'name3'       => 1,
                        'name4_one'   => 1,
                        'name4_two'   => 1
                );
        $res = Msd_Html::getPrefixArray($array);
        $expected = array(
                            'name'  => 'name',
                            'name2' => 'name2',
                            'name4' => 'name4'
                    );
        $this->assertSame($expected, $res);
    }

    public function testCanBuildHtmlOptions()
    {
        $options = array(
                        'first' => 0,
                        'second' => 1,
                        'third'  => 2
                   );
        $res = Msd_Html::getHtmlOptions($options, '', false);
        $expected = "<option value=\"first\">0</option>\n"
                    . "<option value=\"second\">1</option>\n"
                    ."<option value=\"third\">2</option>\n";
        $this->assertSame($expected, $res);
    }

    public function testCanBuildHtmlOptionsWithSeletedOption()
    {
        $options = array(
                        'first' => 0,
                        'second' => 1,
                        'third'  => 2
                   );
        $res = Msd_Html::getHtmlOptions($options, 'second', false);
        $expected = "<option value=\"first\">0</option>\n"
                    . "<option value=\"second\" selected=\"selected\">1</option>\n"
                    . "<option value=\"third\">2</option>\n";
        $this->assertSame($expected, $res);
    }

    public function testCanBuildHtmlOptionsAndShowAllOption()
    {
        $options = array(
                        'first' => 0,
                        'second' => 1,
                        'third'  => 2
                   );
        $res = Msd_Html::getHtmlOptions($options, 'second', true);
        $expected = "<option value=\"\">---</option>\n"
                    . "<option value=\"first\">0</option>\n"
                    . "<option value=\"second\" selected=\"selected\">1</option>\n"
                    . "<option value=\"third\">2</option>\n";
        $this->assertSame($expected, $res);
    }

}