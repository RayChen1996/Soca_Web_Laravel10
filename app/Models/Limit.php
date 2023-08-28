<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Limit extends Model
{
    use HasFactory;


    protected $table = 'LIMIT'; // 資料表名稱
    protected $primaryKey = 'L_IDX'; // 主鍵名稱



}
