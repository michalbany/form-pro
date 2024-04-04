<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageComponent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'page_id',
        'type',
        'position',
        'settings',
        'group_id',
        'content'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
