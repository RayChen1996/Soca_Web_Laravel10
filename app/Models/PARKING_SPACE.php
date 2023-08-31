<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PARKING_SPACE extends Model
{
    use HasFactory;

    protected $table = 'PARKING_SPACE';
    protected $primaryKey = 'IDX'; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記

}
