<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable=['image','ftitle','stitle','status'];

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('ftitle', 'like', "%$search%")
                ->orWhere('stitle', 'like', "%$search%");
        });

    }// end of scopeWhenSearch
}
