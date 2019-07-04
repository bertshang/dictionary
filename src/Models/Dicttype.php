<?php

namespace Bertshang\Dictionary\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dicttype
 * @package Bertshang\Dictionary
 */
class Dicttype extends Model {

    public $timestamps = true;
    protected $guarded = [];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($dicttype) {
            clearCache();
            $dicttype->tag()->delete();
        });

        static::saving(function() {
            clearCache();
        });

        static::creating(function() {
            clearCache();
        });

        static::updating(function() {
            clearCache();
        });
    }

    /**
     * @return mixed
     */
    public function children() {
        return $this->hasMany(Dicttag::class);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function exists($name) {
        return self::where('type', $name)->exists();
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

    public function remove($id) {
        return self::where('id', $id)->delete();
    }

}