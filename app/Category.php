<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $guarded = [];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'category_id', 'id');
    }
}
