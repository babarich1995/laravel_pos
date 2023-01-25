<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'deduction_name',
        'category',
        'is_percentage',
        'description',
        'deduction_amount',
        'deduction_percent'
    
    ];
}
