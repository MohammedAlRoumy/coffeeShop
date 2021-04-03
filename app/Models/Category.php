<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['image','slug','name','status','parent_id'];

    public function children()
    {
        return $this->hasMany( Category::class, 'parent_id', 'id')->withTrashed();
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->withDefault([
                'name' => 'لايوجد تصنيف رئيسي'
            ])->withTrashed();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        });

    }// end of scopeWhenSearch
}
