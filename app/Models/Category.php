<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'description'
  ];

  protected $hidden = [];

  protected $guarded = [
    'id'
  ];

  protected $table = 'categories';

  /**
   * Relationships
   */

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function menuProducts()
  {
    return $this->hasMany(MenuProduct::class);
  }
}
