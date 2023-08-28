<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'HISTORYS'; // 資料表名稱
    protected $primaryKey = 'H_IDX'; // 主鍵名稱
    public $timestamps = false; // 不使用 Eloquent 的預設時間戳記

     // 定義您的表格欄位名稱，這將使您可以輕鬆地在查詢中引用它們
     protected $fillable = [
        'H_CARD', 'H_DATE', 'H_TIME', 'H_DATETIME', 'H_STATE', 'H_RECVDATETIME', 'H_SUBREADER', 'H_SUBREADERNO', 'R_IDX', 'H_READERMODEL'
    ];



    
}
