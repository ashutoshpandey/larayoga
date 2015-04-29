<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class SimilarProduct extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'similar_products';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    protected $hidden = array();

    public function parent()
    {
        return $this->belongsTo('Product', 'parent_product_id');
    }

    public function product()
    {
        return $this->belongsTo('Product', 'similar_product_id');
    }
}