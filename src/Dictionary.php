<?php

namespace Bertshang\Dictionary;

use Bertshang\Dictionary\Models\Dicttype;
use Bertshang\Dictionary\Models\Dicttag;
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
    protected static $dictTypes;

    private static function init() {
        $keys = Cache::get('dict');
        $types = Cache::get('type');
        if ($keys) {
            self::$dictKeys = $keys;
        } else {
            self::getDictionKeysFromDb();
        }
        if ($types) {
            self::$dictTypes = $types;
        } else {
            self::getDictionTypesFromDb();
        }
    }



    /**
     * 从数据库中获取所有的字典
     */
    public static function getDictionKeysFromDb() {
        $info = Dictinfo::
        //where('status', Dictinfo::STATUS_ON)
        select('id','value','dicttag_id','dicttype_id','status')
            ->get();

        $data = $info->groupBy([

            'dicttype_id',
            'dicttag_id',
        ]);


        $data = $data->toArray();
        Cache::forever('dict', $data);
        self::$dictKeys = $data;
        return $data;
    }

    public static function getDictionTypesFromDb() {
        $data = Dicttype::with("children:id,name,status,dicttype_id")->select('id', 'type','status')->get()->toArray();
        Cache::forever('type', $data);
        self::$dictTypes = $data;
        return $data;
    }

    /**
     * @param $key
     * @return mixed
     * @throws LogicException
     * 获取某种类型字典的数据
     */
    public function getKey($type, $key, $status = false) {
        if (!self::$dictKeys) {
            self::init();
        }

        $keys = self::$dictKeys;

        if(!isset($keys[$type][$key])) {
            throw new LogicException('not found the key '. $key);
        }

        $result = $keys[$type][$key];

        if (!$result) {
            return null;
        }

        if (!$status) {

            $filtered = collect($result)->filter(function ($item) {
                return $item['status'] == 0;
            });

            $result = $filtered->all();
        }

        return $result;
    }

    public function getTypes() {
        if (!self::$dictTypes) {
            self::init();
        }

        $types = self::$dictTypes;

        return $types;
    }


    public function getAll() {
        $keys = Cache::get('dict');

        if ($keys) {
            self::$dictKeys = $keys;
            return self::$dictKeys;
        } else {
            return self::getDictionKeysFromDb();
        }
    }

    /**
     * 清除缓存
     */
    public function clearCache() {
        Cache::forget('dict');
        Cache::forget('type');
    }
}