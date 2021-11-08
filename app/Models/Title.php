<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    //可以大量寫入+軟刪
    protected $fillable = ['text', 'img', 'sh'];
}
