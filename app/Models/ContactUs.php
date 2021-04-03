<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'fname','lname','email','title','content'
    ];

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('fname', 'like', "%$search%")
                ->orWhere('lname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('title', 'like', "%$search%");
        });

    }// end of scopeWhenSearch
}
