<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoUpdateCard extends Model
{
    use HasFactory;
    protected $table = 'AUTO_UPDATE';
    protected $primaryKey = 'IDX'; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記



}
