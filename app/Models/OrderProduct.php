<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'order_id',
    'product_id',
    'quantity',
    'price'
  ];

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'updated_at'
  ];

  protected $table = 'order_products';

  /**
   * Relationships
   */
  public function order()
  {
    return $this->belongsTo(Order::class, 'order_id');
  }

  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
