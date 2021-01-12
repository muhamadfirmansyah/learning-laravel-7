<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'category_id', 'id');
    }
}
