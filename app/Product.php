<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','added_by'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getAll()
    {
        return [
            'ProductPrice' => $this->hasOne('App\ProductPrice')->first(),
            'ProductQuantity' => $this->hasOne('App\ProductQuantity')->first(),
            'ProductImage' => $this->hasOne('App\ProductImage')->first()
        ];
    }

    public function getImages()
    {
        return $this->hasOne('App\ProductImage')->first();
    }

    public function getPrice()
    {
        return $this->hasOne('App\ProductPrice')->first();
    }

    public function getQuantity()
    {
        return $this->hasOne('App\ProductQuantity')->first();
    }

    public function getBranch()
    {
        return $this->belongsTo('App\Branch', 'branch_id', 'id');
    }

}
