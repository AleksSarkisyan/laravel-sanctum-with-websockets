<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuProduct extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'menu_id',
    'product_id',
    'category_id',
  ];

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at'
  ];

  protected $table = 'menus_products';

  /**
   * Relationships
   */
  public function user()
  {
    return $this->belongsTo(RestaurantUser::class, 'user_id');
  }

  public function product()
  {
    return $this->belongsTo(Product::class, 'user_id');
  }

  public function menu()
  {
    return $this->belongsTo(Menu::class, 'user_id');
  }
}
