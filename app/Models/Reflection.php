<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reflection extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reflections';
    protected $guarded = ['id'];
}
