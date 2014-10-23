<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
    public function seeExceptionThrown($exception, $function)
    {
        try {
            $function();
            return false;
        } catch (\Exception $e) {
            if (get_class($e) == $exception) {
                return true;
            }
            return false;
        }
    }
}
