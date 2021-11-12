<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'href', 'menu_id '];

    public function menu()
    {
        // 找主選單
        return $this->belongsTo("App\Models\Menu");
    }
}
