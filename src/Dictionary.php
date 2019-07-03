<?php

namespace Bertshang\Dictionary;

use Bertshang\Dictionary\Models\Dicttype;
use Bertshang\Dictionary\Models\Dictinfo;
use Illuminate\Support\Facades\Cache;
use Bertshang\Dictionary\Exceptions\InvalidArgumentException;
use Bertshang\Dictionary\Exceptions\LogicException;

/**
 * Class Dictionary
 * @package Bertshang\Dictionary
 */
class Dictionary {
    /**
     * @var $dictKeys
     * 缓存的字典
     */
    protected static $dictKeys;

    private static function init() {
        $keys = Cache::get('dict');

        if ($keys) {
           self::$dictKeys = $keys;
        } else {
            self::getDictionKeysFromDb();
        }
    }

    /**
     * 从数据库中获取所有的字典
     */
    public static function getDictionKeysFromDb() {
        $info = Dictinfo::
                    //where('status', Dictinfo::STATUS_ON)
                    get();
        $data = $info->groupBy(function ($item, $key) {
            return Dicttype::where('dicttype_id', $item['dicttype_id'])->value('name');
        });

        Cache::forever('dict', $data);
        self::$dictKeys = $data;
        return $data;
    }

    /**
     * @param $key
     * @return mixed
     * @throws LogicException
     * 获取字典的数据
     */
    public function getKey($key, $status = false) {
        if (!self::$dictKeys) {
            self::init();
        }

        $keys = self::$dictKeys;
        if(isset($keys[$key])) {
            throw new LogicException('not found the key '. $key);
        }

        $result = $keys[$key];

        if (!$result) {
            return null;
        }

        if (!$status) {
            //去掉禁用的
            $result = array_filter($result, function ($item) {
                if ($item['status'] == 0) {
                    return true;
                } else {
                    return false;
                }
            });
        }

        return $result;
    }

    /**
     * 清除缓存
     */
    public function clearCache() {
        Cache::forget('dict');
    }
}