<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dep extends Model
{
    use HasFactory;

    protected $table = 'DEP'; // 資料表名稱
    protected $primaryKey = 'DEP_NO'; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記

      

}
