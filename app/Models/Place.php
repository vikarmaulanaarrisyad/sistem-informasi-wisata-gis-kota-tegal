<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    protected $table = 'places';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
