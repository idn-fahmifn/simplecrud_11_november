<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'uuid', 'category_name'
    ];

    public function item()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

}
