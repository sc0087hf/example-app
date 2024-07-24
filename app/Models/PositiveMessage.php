<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositiveMessage extends Model
{
    use HasFactory;

    protected $table = 'positive_messages';

    protected $fillable = [
        'message',
    ];
}
