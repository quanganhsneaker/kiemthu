<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * Các thuộc tính có thể gán giá trị.
     *
     * @var array<string>
     */
    protected $fillable = ['user_id', 'admin_id', 'message', 'is_admin', 'is_read'];

    /**
     * Định nghĩa quan hệ: Một Message thuộc về một User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
