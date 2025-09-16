<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    protected $fillable = [
        'borrower_name',
        'item_name',
        'quantity',
        'borrow_date',
        'return_date',
        'status'
    ];
}
