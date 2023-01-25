<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;
    protected $fillable = [
        'allowance_name',
        'category',
        'is_percentage',
        'description',
        'allowance_amount',
        'percent'
    
    ];
}
