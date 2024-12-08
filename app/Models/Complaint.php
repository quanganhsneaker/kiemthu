<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'product_id', 'phone', 'gender', 'product', 'complaint_message','status'
    ];
}
