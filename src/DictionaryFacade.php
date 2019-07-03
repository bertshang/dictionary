<?php

namespace Bertshang\Dictionary;
use Illuminate\Support\Facades\Facade;

/**
 * Class DicFacade
 * @package Bertshang\Dictionary
 */
class DictionaryFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dic';
    }
}