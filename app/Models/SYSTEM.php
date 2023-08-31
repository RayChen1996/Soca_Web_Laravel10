<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SYSTEM extends Model
{
    use HasFactory;

    
    protected $table = 'SYSTEM';
    protected $primaryKey = null; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記
}
