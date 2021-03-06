<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = [
        'profit'
    ];

    protected $attributes = [
        'image' => 'def.png'
    ];

    protected $dates = ['date'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function getProfitAttribute()
    {
        return $this->price - $this->purchase_price;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d H:m:s');
    }
    public function getPriceAttribute($price)
    {
        return $this->attributes['price'] = number_format($price, 2);
    }

    public function getPurchasePriceAttribute($price)
    {
        return $this->attributes['purchase_price'] = number_format($price, 2);
    }
}
