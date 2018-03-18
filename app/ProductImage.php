<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_image';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'img_1', 'img_2', 'img_3', 'img_4', 'img_5'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getProduct() {
        return $this->belongsTo('App\Product','product_id','id');
    }

}
