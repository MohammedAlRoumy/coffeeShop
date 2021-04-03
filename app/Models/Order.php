<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'order_number', 'user_id','coupon_id','admin_id','discount','status', 'grand_total', 'item_count', 'payment_status', 'payment_method',
        'firstname', 'lastname', 'address', 'city', 'country', 'post_code', 'email','phone', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id')->withTrashed();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class)->withTrashed();
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('order_number', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('payment_method', 'like', "%$search%");
        });

    }// end of scopeWhenSearch
}
