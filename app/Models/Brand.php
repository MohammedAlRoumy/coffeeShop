<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable=['logo','slug','name','status'];

    public function products()
    {
        return $this->hasMany(Product::class)->withTrashed();
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        });

    }// end of scopeWhenSearch
}
