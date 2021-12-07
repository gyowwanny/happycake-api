<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeEmail extends Model
{
    use HasFactory;

    protected $fillable = array(
        'email',
        'cake_id'
    );
}
