<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'GROUPS'; // 資料表名稱
    protected $primaryKey = 'G_IDX'; // 主鍵名稱
}
