<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // khai báo tên bảng
    protected $table = 'orderdetail';

    // khai báo khóa chính của bảng
    protected $primaryKey = 'id';
}
