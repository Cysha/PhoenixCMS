<?php

use Illuminate\Support\Debug\Dumper;

class Debug
{
    /**
     * Pretty wrapper to print_r()
     *
     * @version     1.0
     * @since       1.0.0
     * @author      xLink
     *
     * @param       variable        $var
     * @param       string          $info
     *
     * @return      string
     */
    public static function dump($var, $info = false, $color='#0E5B72')
    {
        if (!in_Array(app()->environment(), array('dev', 'local'))){ return; }

        // actually do the debug & grab it in some output buffering
        ob_start();
        (new Dumper)->dump($var);
        $debug = ob_get_clean();

        // if we happen to be running in the console
        if (app()->runningInConsole()) {
            // return the debug without any extras
            return $debug;
        }
        // otherwise

        // get where this is being called from
        $debug     = debug_backtrace();
        $call_info = array_shift($debug);
        $code_line = $call_info['line'];
        $filePath  = $call_info['file'];

        // get the current document root :)
        $docRoot = (isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : null);
        $docRoot = explode('/', $docRoot);
        $docRoot = array_filter($docRoot);
        array_pop($docRoot);
        $docRoot = implode('/', $docRoot);

        $filePath = str_replace('\\', '/', $filePath);
        $filePath = str_replace(array($docRoot, '/~'), '~', $filePath);

        $return = '';

        // setup a little prettyness
        $id = substr(md5(microtime()), 0, 6);
        $return .= sprintf('<div class="debug-dump" style="overflow: auto; margin: 0 0 10px 0; background: white; color: black; font-family: Verdana; border: 1px solid #cccccc; padding: 5px; font-size: 10px; line-height: 12px; display: block; max-width: 1000px;text-align: left;"><div><div class="header" style="background-color: '.$color.'; color: white; padding: 3px 5px; font-size: 12px; margin: 0 0 5px;"></div>DEBUG! (<strong>%s : %s</strong>)', $filePath, $code_line);
            if ($info != false) {
                $return .= ' | <strong style="color: red;">'.$info.':</strong>';
            }
            $return .= '</div>';


        $return .= $debug.'</div>';

        // BOOM! :D
        return $return;
    }

    public static function console($var)
    {
        if (!class_exists('Debugbar')) {
            return;
        }
        \Debugbar::addMessage($var);
    }

}
