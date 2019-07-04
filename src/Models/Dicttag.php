<?php

namespace Bertshang\Dictionary\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dicttype
 * @package Bertshang\Dictionary
 */
class Dicttag extends Model {
    public $timestamps = true;


    protected static function boot()
    {
        parent::boot();

        static::deleting(function($dicttag) {
            clearCache();
            $dicttag->info()->delete();
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
    public function info() {
        return $this->hasMany(Dictinfo::class);
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
        return self::where('name', $name)->delete();
    }

}