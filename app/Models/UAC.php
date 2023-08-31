<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UAC extends Model
{
    use HasFactory;

    protected $table = 'UAC';
    protected $primaryKey = 'U_IDX'; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記
}
