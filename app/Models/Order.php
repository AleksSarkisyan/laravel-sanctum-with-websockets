<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'restaurant_id',
    'total_quantity',
    'total_price'
  ];

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at'
  ];

  /**
   * Relationships
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function restaurant()
  {
    return $this->belongsTo(Restaurant::class, 'restaurant_id');
  }

  public function orderProducts()
  {
    return $this->hasMany(OrderProduct::class, 'order_id');
  }
}
