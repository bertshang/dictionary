<?php

/*
 * This file is part of the bertshang/dictionary.
 *
 * (c) bertshang <359352960@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!function_exists('getKey')) {
    function getKey($key, $staus = false)
    {
        return app('dictionary')->getKey($key, $staus);
    }
}

if (!function_exists('clearCache')) {
    /**
     * @return mixed
     *               清除缓存
     */
    function clearCache()
    {
        return app('dictionary')->clearCache();
    }
}

if (!function_exists('getAll')) {
    function getAll()
    {
        return app('dictionary')->getAll();
    }
}

if (!function_exists('getTypes')) {
    function getTypes()
    {
        return app('dictionary')->getTypes();
    }
}
