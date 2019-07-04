<?php

namespace Bertshang\Dictionary\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dictinfo
 * @package Bertshang\Dictionary
 */
class Dictinfo extends Model {

    const STATUS_ON = 0;
    const STATUS_OFF = 1;
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function() {
            clearCache();
        });

        static::saving(function() {
            clearCache();
        });

        static::creating(function() {
            clearCache();
        });
    }
    /**
     * @return mixed
     */
    public function type() {
        return $this->belongsTo(Dicttype::class);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function exists($name) {
        return self::where('name', $name)->exists();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function add(array $data) {
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
     * @return bool
     */
    public function edit($id, $data) {
        try {
            self::where('id', $id)->update($data);

            return true;
        } catch (\Exception $e) {

            return false;
        }
    }

    public function remove($name) {
        return self::where('value', $name)->delete();
    }


}