<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden = array();

    public static $rules = array('name' => 'required|min:3');

    public static function saveFormData($data)
    {
        $id = DB::table('categories')->insertGetId($data);

        return $id;
    }

    public static function updateFormData($data)
    {
        return DB::table('categories')->update($data);
    }

    public function products() {
        return $this->belongsToMany('Product', 'category_products', 'product_id', 'category_id');
    }
}