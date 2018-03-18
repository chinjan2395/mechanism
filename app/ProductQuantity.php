<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQuantity extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_quantity';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'quantity'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getProduct() {
        return $this->belongsTo('App\Product','product_id','id');
    }

}
