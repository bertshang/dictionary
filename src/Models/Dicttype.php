<?php

namespace Bertshang\Dictionary\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dicttype
 * @package Bertshang\Dictionary
 */
class Dicttype extends Model {
    public $timestamps = true;

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
    public function create(array $data) {
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
    public function update($id, $data) {
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