<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'href', 'sh'];

    public function subs()
    {
        //$this 指這個class本身
        return $this->hasMany("App\Models\SubMenu");
    }
}
