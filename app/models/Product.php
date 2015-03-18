<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden = array();

    public static function saveFormData($data)
    {
        $id = DB::table('products')->insertGetId($data);

        return $id;
    }

    public static function updateFormData($data)
    {
        return DB::table('products')->update($data);
    }
}