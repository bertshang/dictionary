<?php
if (! function_exists('getKey')) {

    function getKey($key, $staus = false)
    {

        return app('dictionary')->getKey($key, $staus);
    }
}

if (! function_exists('clearCache')) {
    /**
     * @return mixed
     * 清除缓存
     */
    function clearCache()
    {
        return app('dictionary')->clearCache;
    }
}

if (! function_exists('getAll')) {

    function getAll()
    {
        return app('dictionary')->getAll();
    }
}