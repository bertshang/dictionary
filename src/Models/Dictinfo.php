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
        return self::where('value', $name)->delete();
    }


}