<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'quantity', 'price', 'sale_price', 'status', 'brand_id', 'category_id'];

    protected $appends = ['is_favored'];
    public function brand()
    {
        return $this->belongsTo(Brand::class)->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product')->withTrashed();
    }

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->orWhere('sale_price', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%");
        });

    }// end of scopeWhenSearch


    public function getIsFavoredAttribute()
    {
        if (auth()->user()) {
            return (bool)$this->users()->where('user_id', auth()->user()->id)->count();
        }//end of if

        return false;

    }// end of getIsFavoredAttribute

    public function scopeWhenCategory($query, $category)
    {
        return $query->when($category, function ($q) use ($category) {

//            return $q->where('category', function ($qu) use ($category) {

                return $q->where('category_id', $category)
                    ->orWhere('name', $category);

//            });

        });

    }// end of scopeWhenCategory


    public function scopeWhenFavorite($query, $favorite)
    {

        return $query->when($favorite, function ($q) {

            return $q->whereHas('users', function ($qu) {

                return $qu->where('user_id', auth()->user()->id);
            });

        });

}// end of scopeWhenFavorite


 /*   public function getImageAttribute($value)
    {
        return url('uploads/images/products/' . $value);
    }*/
}
