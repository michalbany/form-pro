<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    protected $fillable = ['name'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Vrátí všechny stránky projektu, které nemají rodiče
     */
    public function scopeParentPages()
    {
        return $this->pages()->whereNull('parent_id');
    }
}