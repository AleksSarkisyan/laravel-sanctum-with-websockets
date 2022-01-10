<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'city'
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
}
