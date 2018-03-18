<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_price';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'amount'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getProduct() {
        return $this->belongsTo('App\Product','product_id','id');
    }

}
