<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{   protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
];
    use HasFactory;
}
