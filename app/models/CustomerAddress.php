<?php

class CustomerAddress extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_addresses';

    public function customer()
    {
        return $this->belongsTo('Customer');
    }
}