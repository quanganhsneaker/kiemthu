<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // Tên bảng trong cơ sở dữ liệu
    protected $fillable = ['name', 'material', 'image']; // Các cột có thể truy cập
}
