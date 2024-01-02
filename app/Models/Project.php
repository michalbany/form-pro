<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}