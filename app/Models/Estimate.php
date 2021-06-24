<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Estimate extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'price'
    ];

    protected $fillable = [
        'description',
        'price',
        'car_id',
        'author_id',
        'customer_id',
    ];

    protected $appends = [
        'unique_code'
    ];

    public function getUniqueCodeAttribute(){
        return $this->code . '-' . $this->created_at;
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
