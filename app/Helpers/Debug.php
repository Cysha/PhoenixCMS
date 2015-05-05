<?php


class Debug {

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
    public static function dump($var, $info = false, $color='#0E5B72') {
        if( !in_Array(App::environment(), array('dev', 'local')) ){ return; }
        $scope = false;
        $prefix = 'unique';
        $suffix = 'value';

        $vals = ($scope ? $scope : $GLOBALS);

        $old = $var;
        $var = $new = $prefix.rand().$suffix;
        $vname = false;
        foreach($vals as $key => $val) {
            if ($val === $new) {
                $vname = $key;
            }
        }
        $var = $old;

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

        $id = substr(md5(microtime()), 0, 6);
        $return .= sprintf('<div class="debug" style="overflow: auto; margin: 0 0 10px 0; background: white; color: black; font-family: Verdana; border: 1px solid #cccccc; padding: 5px; font-size: 10px; line-height: 12px; display: block; max-width: 1000px;text-align: left;"><div><div class="header" style="background-color: '.$color.'; color: white; padding: 3px 5px; font-size: 12px; margin: 0 0 5px;"></div>DEBUG! (<strong>%s : %s</strong>)', $filePath, $code_line);
            if ($info != false) {
                $return .= ' | <strong style="color: red;">'.$info.':</strong>';
            }
            $return .= '</div><ul id="debug_'.$id.'" style="display: block;list-style-type: none; color: black; margin: 0 10px; padding: 0;">'.self::doDump($var, '$'.$vname).'</ul>';
        $return .= '</div>';

        return $return;
    }

    /**
     * Internal function used with dump();
     *
     * @access      private
     * @version     2.0
     * @since       1.0.0
     * @author      xLink
     *
     * @param       variable        $var
     * @param       string          $var_name
     * @param       string          $indent
     * @param       string          $reference
     *
     * @return      string
     */
    public static function doDump($var, $var_name = null, $indent = null, $reference = null, $counter = 0) {
        $do_dump_indent = '&nbsp;&nbsp; ';
        $reference = $reference.$var_name;
        $keyvar = 'the_do_dump_recursion_protection_scheme';
        $keyname = 'referenced_object_name';
        $return = '';

        //if($counter >= 6){ return; }

        $return .= '<li>';
        if (is_array($var) && isset($var[$keyvar])) {
            $real_var = &$var[$keyvar];
            $real_name = &$var[$keyname];
            $type = ucfirst(gettype($real_var));
            $return .= $indent.$var_name.'<span class="ident">'.$type.'</span> = <span style="color:#e87800;">&amp;'.$real_name.'</span><br />';
        } else {
            $var = array($keyvar => $var, $keyname => $reference);
            $avar = &$var[$keyvar];

            $type = ucfirst(gettype($avar)); $type_color = '<span style="color:black">'; $color = 'black';
            if ($type == 'String') {
                $type_color = '<span style="color:green">';
                $color = 'green';
            } elseif($type == 'Integer') {
                $type_color = '<span style="color:red">';
                $color = 'red';
            } elseif($type == 'Double') {
                $type_color = '<span style="color:#0099c5">'; $type = 'Float';
                $color = '#0099c5';
            } elseif($type == 'Boolean') {
                $type_color = '<span style="color:#92008d">';
                $color = '#92008d';
            } elseif($type == 'null') {
                $type_color = '<span style="color:black">';
                $color = 'black';
            } elseif($type == 'Resource') {
                $type_color = '<span style="color:#00c19f">';
                $color = '#00c19f';
            }

            $keyNames = array('[\'password\']', '[\'pin\']');
            $avar = in_array($var_name, $keyNames) ? str_pad('', (strlen($avar)), '*') : $avar;

            #$label = '<span class="label" style="background-color: %2$s; color: white;">%1$s</span>';
            #$var_name = sprintf($label, $var_name, $color);


            if (is_array($avar)) {
                $count = count($avar);
                $return .= ''.$indent.($var_name ? $var_name.' => ' : '').'<span class="ident">'.$type.'('.$count.')</span>'.$indent.'<ul style="display: block;list-style-type: none; color: black; margin: 0 10px; padding: 0 0 0 10px;">(';
                $keys = array_keys($avar);
                foreach($keys as $name) {
                    $value = &$avar[$name];
                    $return .= self::doDump($value, '["'.$name.'"]', $indent.$do_dump_indent, $reference, 1);
                }
                $return .= ")</ul>";
            } elseif(is_object($avar)) {
                $return .= $indent.$var_name.' <span class="ident">'.$type.'<small>('.get_class($avar).')</small></span>'.$indent.'<ul style="display: block;list-style-type: none; color: black; margin: 0 10px;  padding: 0 0 0 10px;">(';
                $_indent = $indent.$do_dump_indent;

                foreach((array)$avar as $key => $value){
                    $return .= self::doDump($value, "->". $key, $indent.$do_dump_indent, $reference, $counter++);
                }
                //$return .= '<pre>'.print_r($avar, true).'</pre>';

                $return .= ")</ul>";
            } elseif(is_int($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.$type_color.$avar.'</span>';
            } elseif(is_string($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.
                                $type_color.'"'.str_replace(str_split("\t\n\r\0\x0B"), '', htmlspecialchars($avar)).'"</span>';
            } elseif(is_float($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.$type_color.$avar.'</span>';
            } elseif(is_bool($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.
                                $type_color.($avar == 1 ? 'true' : 'false').'</span>';
            } elseif(is_null($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.$type_color.'NULL</span>';
            } elseif(is_resource($avar)) {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'</span> '.$type_color.$avar.'</span>';
            } else {
                $return .= $indent.$var_name.' = <span class="ident">'.$type.'('.strlen($avar).')</span> '.
                                "$avar";
            }
            $var = $var[$keyvar];

        }
        $return .= '</li>';
        return $return;
    }

    public static function console($var){
        \DebugBar::addMessage($var);
    }

}