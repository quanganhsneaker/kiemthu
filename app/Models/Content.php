<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_title',
        'promotion_description',
        'remaining_quantity',
        'company_title',
        'company_description',
        'return_policy',
        'feedback_text',
        'hpvenus_image',
        'asustuf_image',
        'teddyshop_image',
        'feedback_image',
    ];
}
