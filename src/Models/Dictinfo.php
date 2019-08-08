<?php

/*
 * This file is part of the bertshang/dictionary.
 *
 * (c) bertshang <359352960@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bertshang\Dictionary\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dictinfo.
 */
class Dictinfo extends Model
{
    const STATUS_ON = 0;

    const STATUS_OFF = 1;

    public $timestamps = true;

    protected $fillable = [
        'value', 'dicttag_id', 'dicttype_id', 'user_id', 'status', 'sort', 'remark',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function () {
            clearCache();
        });

        static::saving(function () {
            clearCache();
        });

        static::creating(function () {
            clearCache();
        });

        static::updating(function () {
            clearCache();
        });
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->belongsTo(Dicttype::class);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function exists($name)
    {
        return self::where('name', $name)->exists();
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function add(array $data)
    {
        try {
            self::create($data);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    public function edit($id, $data)
    {
        try {
            self::where('id', $id)->update($data);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function remove($name)
    {
        return self::where('value', $name)->delete();
    }
}
