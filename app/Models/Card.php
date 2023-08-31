<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'CARDS';
    protected $primaryKey = 'C_IDX'; // 主鍵名稱
     


}
