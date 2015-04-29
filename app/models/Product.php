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

    public static $rules = array('name' => 'required|min:3');

    protected $fillable = array('name', 'sku', 'quantity', 'price', 'special_price', 'pre_order', 'url_key', 'description', 'page_title', 'custom_json_data', 'header_data', 'update_type');

    public static function saveFormData($data)
    {
        $id = DB::table('products')->insertGetId($data);

        return $id;
    }

    public static function updateFormData($data)
    {
        return DB::table('products')->update($data);
    }

    public function similarProducts()
    {
        return $this->hasMany('SimilarProduct');
    }

    public function categories() {
        return $this->belongsToMany('Category', 'category_products', 'product_id', 'category_id');
    }
}