<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'description',
    'is_active'
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
    return $this->belongsTo(RestaurantUser::class, 'user_id');
  }

  public function menuProducts()
  {
    return $this->hasMany(MenuProduct::class, 'user_id');
  }
}
