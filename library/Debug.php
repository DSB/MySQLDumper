<?php
/**
 * Statische Klasse für Debug-Ausgaben.
 *
 * Die Klassenkonstanten sind global mit dem Präfix <i>DEBUG_</i> verfügbar.
 *
 * @package     MySQLDumper
 * @author      D4rk4ng3l
 * @version     0.3
 * @copyright   2010 Stefan 'D4rk4ng3l' Krenz
 */
/**
 * Debug class by Stefan Krenz
 * 
 * @package     MySQLDumper
 *
 */
class Debug
{
    /**
     * Debug-Ausgabe als einfacher Text.
     */
    const OUTPUT_PLAIN = 0x000001;

    /**
     * Debug-Ausgabe als HTML-Quelltext.
     */
    const OUTPUT_HTML = 0x000002;

    /**
     * Debug-Ausgabe als HTML-Kommentar.
     */
    const OUTPUT_HTML_COMMENT = 0x000003;

    /**
     * Debug-Ausgabe in einer Datei als einfacher Text.
     * {@link Debug::setOutputFilename()}
     */
    const OUTPUT_FILE = 0x000004;

    /**
     * Debug-Ausgabe als Javascript Kommentar.
     */
    const OUTPUT_JAVASCRIPT = 0x000005;

    /**
     * Alias für {@link Debug::OUTPUT_JAVASCRIPT}
     */
    const OUTPUT_JS         = 0x000005;

    /**
     * Backtrace-Ausgabe deaktivieren.
     */
    const BACKTRACE_NONE = 0x000100;

    /**
     * Einfache Backtrace-Ausgabe. Gibt nur die <i>Debug::out()</i>
     * aufrufende Funktion aus.
     */
    const BACKTRACE_SIMPLE = 0x000200;

    /**
     * Komplexe Backtrace-Ausgabe. Gibt alle aufrufenden Funktionen aus.
     */
    const BACKTRACE_COMPLETE = 0x000300;

    /**
     * HTML-Quelltext im HTML-Format ausgeben.
     */
    const HTMLMODE_HTML = 0x010000;

    /**
     * HTML-Quelltext im XHTML-Format ausgeben.
     */
    const HTMLMODE_XHTML = 0x020000;

    /**
     * Speichert den Modus für die Debug-Ausgabe.
     *
     * Siehe auch:
     * {@link Debug::OUTPUT_PLAIN}
     * {@link Debug::OUTPUT_HTML}
     * {@link Debug::OUTPUT_HTML_COMMENT}
     * {@link Debug::OUTPUT_FILE}
     *
     * @var int Ausgabemodus
     * @static
     */
    private static $_outputMode = self::OUTPUT_HTML;

    /**
     * Speichert den Modus für die Backtrace-Ausgabe.
     *
     * Siehe auch:
     * {@link Debug::BACKTRACE_NONE}
     * {@link Debug::BACKTRACE_SIMPLE}
     * {@link Debug::BACKTRACE_COMPLETE}
     *
     * @var int Backtracemodus
     * @static
     */
    private static $_backtraceMode = self::BACKTRACE_SIMPLE;

    /**
     * Speichert den Modus für die HTML-Ausgabe.
     *
     * Siehe auch: {@link Debug::HTMLMODE_HTML, Debug::HTMLMODE_XHTML}
     *
     * @var int HTML-Quelltext-Modus
     * @static
     */
    private static $_htmlMode = self::HTMLMODE_HTML;

    /**
     * Speichert Informationen über die registrierten Callback-Funktionen.
     *
     * Nähere Informationen zum <i>callback</i> Typ:
     * siehe PHP-Manual
     *
     * @var array Benutzerdefinierte Callback-Funktionen
     * @static
     */
    private static $_callbacks = array(
        self::OUTPUT_PLAIN          => array(__CLASS__, 'defaultCallback'),
        self::OUTPUT_HTML           => array(__CLASS__, 'defaultCallback'),
        self::OUTPUT_HTML_COMMENT   => array(__CLASS__, 'defaultCallback'),
        self::OUTPUT_FILE           => array(__CLASS__, 'defaultCallback'),
        self::OUTPUT_JAVASCRIPT     => array(__CLASS__, 'defaultCallback'),
    );
    
    /**
     * Speichert den Inhalt der zuletzt ausgegebenen Variablen.
     *
     * @var mixed Letzte ausgegebene Variable.
     * @static
     */
    private static $_lastVariable = null;

    /**
     * Speichert den Backtrace der letzten Debug-Ausgabe.
     *
     * @var array Backtrace der letzten Debug-Ausgabe
     * @static
     */
    private static $_lastBacktrace = null;

    /**
     * Speichert den HTML-Quellcode für den Zeilenumbruch,
     * basierend auf dem aktuellen HTML-Ausgabe-Modus.
     *
     * @var string Zeilenumbruch für HTML-Ausgabe
     */
    private static $_htmlLineBreak = "<br>\n";

    /**
     * Speichert den Dateinamen für die Dateiausgabe.
     * 
     * Siehe auch: {@link Debug::OUTPUT_FILE}
     *
     * @var string Dateiname für die Debug-Ausgabe
     */
    private static $_outputFilename = 'debug.txt';

    /**
     * Deaktivierter Konstruktor. Klasse ist nur statisch zu benutzen.
     */
    private function __construct()
    {
    }

    /**
     * Deaktiviertes klonen.
     */
    private function __clone()
    {
    }
    
    /**
     * Gibt eine typbasierte Ausgabe zurück.
     * 
     * Ist $arg ein Array, so wird 'Array' zurückgeben.
     * Ist $arg ein Objekt, so wird der Name der Klasse zurückgeben.
     * Ist $arg ein Boolean, so wird 'TRUE' bzw. 'FALSE' zurückgeben.
     * Ist $arg ein String, so wird er in Anführungsstriche gesetzt.
     * Ist $arg null, so wird 'NULL' zurückgeben.
     * Ist der Typ der Variablen $arg unbekannt,
     * so wird die Variable selbst zurückgegeben.
     *
     * @param mixed $arg Funktionparameter
     * 
     * @return mixed
     */
    private static function getArg($arg)
    {
        if (is_array($arg)) {
            $result = 'Array';
        } elseif (is_object($arg)) {
            $result = get_class($arg);
        } elseif (is_bool($arg)) {
            $result = $arg ? 'TRUE' : 'FALSE';
        } elseif (is_string($arg)) {
            $result = '"' . $arg . '"';
        } elseif (is_null($arg)) {
            $result = 'NULL';
        } else {
            $result = $arg;
        }
        return $result;
    }

    private static function _getBacktrace($backtrace, $outputBacktraceType)
    {
        $outputBacktrace = '';
        switch ($outputBacktraceType) {
            case self::BACKTRACE_NONE:
                break;
            case self::BACKTRACE_SIMPLE:
                $outputBacktrace = 'Debugoutput called from '
                    . $backtrace[0]['file'] . '['
                    . $backtrace[0]['line'] . ']';
                break;
            case self::BACKTRACE_COMPLETE:
                foreach ($backtrace as $traceNum => $trace) {
                    $args = (count($trace['args']) > 0) ? 
                        self::getArg($trace['args'][0]) : '';
                    for ($i = 1; $i < count($trace['args']); $i++) {
                        $args .= ', ' . self::getArg($trace['args'][$i]);
                    }
                    $outputBacktrace .= '#' . $traceNum . ': ' . $trace['file']
                        . '[' . $trace['line'] . '] ' . $trace['class']
                        . $trace['type'] . $trace['function'] . '('
                        . $args . ")\n";
                }
                break;
            default:
                $outputBacktrace = 'Debugoutput called from '
                    . $backtrace[0]['file'] . '[' . $backtrace[0]['line'] . ']';
                break;
        }
        return $outputBacktrace;
    }
    
    private static function _doOutput(
        $outputFormatType,
        $outputBacktrace,
        $dumpedVar,
        $outputHtmlModeType
    )
    {
        switch ($outputFormatType) {
            case self::OUTPUT_PLAIN:
                echo $outputBacktrace;
                echo $dumpedVar;
                break;
            case self::OUTPUT_HTML:
                echo '<strong>' .
                    nl2br(
                        $outputBacktrace,
                        ($outputHtmlModeType == self::HTMLMODE_XHTML)
                    ) . '</strong>' . self::$_htmlLineBreak;
                echo '<pre>';
                echo htmlspecialchars($dumpedVar);
                echo '</pre>';
                break;
            case self::OUTPUT_HTML_COMMENT:
                echo '<!--' . "\n" . $outputBacktrace . "\n\n";
                echo $dumpedVar;
                echo "\n" . '-->'. "\n";
                break;
            case self::OUTPUT_FILE:
                $output = $outputBacktrace . "\n";
                $output .= $dumpedVar . "\n\n";
                $filePointer = fopen(self::$_outputFilename, "a+");
                fwrite($filePointer, $output);
                fclose($filePointer);
                break;
            case self::OUTPUT_JAVASCRIPT:
                echo "/*\n";
                echo $outputBacktrace . "\n\n";
                echo $dumpedVar;
                echo "\n*/\n";
        }
    }
    
    /**
     * Standard Callback-Funktion
     * 
     * Siehe auch: {@link Debug::$_callbacks}
     *
     * @param mixed $var Variable, die ausgegeben werden soll.
     * @param array $backtrace Backtrace des Aufrufs von <i>Debug::out()</i>
     * @param int $outputFormat Ausgabe-Format
     * 
     * @return void
     */
    public static function defaultCallback($var, $backtrace, $outputFormat)
    {
        $outputFormatType = ($outputFormat | 0xFFFFFF00) ^ 0xFFFFFF00;
        $outputBacktraceType = ($outputFormat | 0xFFFF00FF) ^ 0xFFFF00FF;
        $outputHtmlModeType = ($outputFormat | 0xFF00FFFF) ^ 0xFF00FFFF;

        if ($outputFormatType == 0) {
            $outputFormatType = self::$_outputMode;
        }

        if ($outputBacktraceType == 0) {
            $outputBacktraceType = self::$_backtraceMode;
        }

        if ($outputHtmlModeType == 0) {
            $outputHtmlModeType = self::$_htmlMode;
        }

        self::$_htmlLineBreak = nl2br(
            "\n", 
            ($outputHtmlModeType == self::HTMLMODE_XHTML)
        );

        ob_start();
        var_dump($var);
        $dumpedVar = ob_get_contents();
        ob_end_clean();

        $outputBacktrace = self::_getBacktrace(
            $backtrace,
            $outputBacktraceType
        );

        self::_doOutput(
            $outputFormatType,
            $outputBacktrace,
            $dumpedVar,
            $outputHtmlModeType
        );
    }

    /**
     * Erzeugt eine Ausgabe, die beim Auffinden
     * von Fehlern (debugging) unterstützt.
     *
     * @param mixed $var Variable, die ausgegeben werden soll.
     * @param int $outputFormat Format für die Ausgabe.
     * 
     * @return void
     */
    public static function out($var, $outputFormat = null)
    {
        if ($outputFormat === null) {
            $outputFormat = self::$_outputMode | 
                self::$_backtraceMode | 
                self::$_htmlMode;
        }

        $outputFormatType = ($outputFormat | 0xFFFFFF00) ^ 0xFFFFFF00;
        if ($outputFormatType == 0) {
            $outputFormatType = self::$_outputMode;
            $outputFormat = self::$_outputMode | $outputFormat;
        }
        $backtrace = debug_backtrace();
        if (isset(self::$_callbacks[$outputFormatType])) {
            call_user_func_array(
                self::$_callbacks[$outputFormatType],
                array($var, $backtrace, $outputFormat)
            );
        } else {
            $message = 'Für das angegebene Ausgabeformat wurde keine '
                . 'Callback-Funktion definiert. Format: 0x'
                . sprintf('%8.8X', $outputFormatType);
            throw new Exception($message);
        }

        self::$_lastBacktrace = $backtrace;
        self::$_lastVariable = $var;
    }

    /**
     * Gibt den Backtrace des letzten Aufrufs von <i>Debug::out()</i> zurück.
     *
     * @return array
     */
    public static function getLastBacktrace()
    {
        return self::$_lastBacktrace;
    }

    /**
     * Gibt den Inhalt der zuletzt ausgegebenen Variablen zurück.
     *
     * @return mixed
     */
    public static function getLastVariable()
    {
        return self::$_lastVariable;
    }

    /**
     * Fügt eine Callback-Funktion zum Stack hinzu,
     * diese wird beim Aufruf von <i>Debug::out()</i>
     * automatisch aufgerufen. Diese Funktion muss gleichzeitig den Inhalt
     * des <i>Debug::out()</i> Aufrufs ausgeben.
     *
     * Für nähere Informationen über mögliche
     * Callback-Funktionen {@link Debug::$_callbacks}
     *
     * Die Callback-Funktion muss dem folgenden Format entsprechen:
     * method null callback($var, $backtrace, $outputFormat)
     * {@link Debug::defaultCallback()}
     *
     * Benutze für das Ausgabeformat ($outputFormat)
     * einen Integer zwischen 0x10 und 0xFF.
     *
     * Alternativ kann für $outputFormat auch ein Array übergeben werden.
     * Es gilt dann die Konvention:
     * Index 0: Ausgabeformat (entspricht $outputFormat mit einem Integer)
     * Index 1: Callback-Information (entspricht $callbackFunction)
     *
     * Ausgabeformate sollten global mit dem Präfix
     * 'DEBUG_OUTPUT_' registriert werden.
     * Zusätzliche Ausgabeinformationen können in den
     * Bytes 3 und 4 (0xFFFF0000) übergeben werden.
     *
     * @param mixed $outputFormat Ausgabeformat
     * @param mixed $callbackFunction Informationen über die Callback-Funktion
     * 
     * @return bool
     */
    public static function registerCallbackFunction(
        $outputFormat,
        $callbackFunction = null
    )
    {
        if (is_array($outputFormat)) {
            self::$_callbacks[$outputFormat[0]] = $outputFormat[1];
            return is_callable($outputFormat[1]);
        } else {
            self::$_callbacks[$outputFormat] = $callbackFunction;
            return is_callable($callbackFunction);
        }
    }

    /**
     * Entfernt eine Callback-Funktion vom Stack.
     *
     * @param int $outputFormat Ausgabeformat
     */
    public static function unregisterCallbackFunction($outputFormat)
    {
        unset(self::$_callbacks[$outputFormat]);
    }

    /**
     * Setzt den Modus für die Ausgabe.
     * {@link Debug::$_outputMode}
     *
     * @param int $outputMode Ausgabemodus
     */
    public static function setDefaultOutputMode($outputMode)
    {
        self::$_outputMode = $outputMode;
    }

    /**
     * Setzt den Modus für den Backtrace.
     *  {@link Debug::$_backtraceMode}
     *
     * @param int $backtraceMode Backtrace-Modus
     */
    public static function setDefaultBacktraceMode($backtraceMode)
    {
        self::$_backtraceMode = $backtraceMode;
    }

    /**
     * Setzt den Modus für die HTML-Ausgabe
     *  {@link Debug::$_htmlMode}
     *
     * @param int $htmlMode HTML-Modus
     */
    public static function setDefaultHtmlMode($htmlMode)
    {
        self::$_htmlMode = $htmlMode;
    }

    /**
     * Setzt den Dateinamen für die Dateiausgabe.
     * {@link Debug::$_outputFilename}
     *
     * @param string $outputFilename Dateiname
     */
    public static function setOutputFilename($outputFilename = 'debug.txt')
    {
        self::$_outputFilename = $outputFilename;
    }
}

$debugReflection = new ReflectionClass('Debug');
$constants = $debugReflection->getConstants();
foreach ($constants as $constantName => $constantValue) {
    define('DEBUG_' . $constantName, $constantValue);
}
