<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextField extends Model
{
    protected $fillable = ['page_id', 'label', 'content', 'recommended_length'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}