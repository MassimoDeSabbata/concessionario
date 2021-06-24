<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Car extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name',
        'code',
        'price',
        'matriculated_at',
    ];

    protected $fillable = [
        'name',
        'code',
        'price',
        'matriculated_at',
        'color',
        'description',
    ];

    public function estimates()
    {
        return $this->hasMany(Estimate::class, 'car_id');
    }
}
