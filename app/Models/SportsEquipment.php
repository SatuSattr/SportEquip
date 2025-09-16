<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportsEquipment extends Model
{
    protected $fillable = [
        'item_name',
        'item_status',
        'item_image',
        'item_quantity'
    ];
}
