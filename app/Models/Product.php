<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'category_id',
    'name',
    'description',
    'price',
    'promo_price',
    'image_url',
    'slug',
    'weight',
    'is_promo',
    'is_active'
  ];

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at'
  ];

  protected $table = 'products';

  /**
   * Relationships
   */
  public function user()
  {
    return $this->belongsTo(RestaurantUser::class, 'user_id');
  }

  public function category()
  {
    return $this->belongsTo(Category::class, 'category_id');
  }

  public function menuProducts()
  {
    return $this->hasMany(MenuProduct::class, 'user_id');
  }

  public function orderProducts()
  {
    return $this->hasMany(OrderProduct::class, 'product_id');
  }
}
