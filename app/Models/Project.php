<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    protected $fillable = ['name'];

    // protected static function boot()
    // {
    //     // generovani URL při vytvoření nebo úpravě projektu
    //     parent::boot();

    //     static::creating(function ($project) {
    //         $project->slug = Str::slug('project') . Str::slug($project->name) . '-' . Str::uuid();
    //     });

    //     static::updating(function ($project) {
    //         $project->slug = Str::slug('project') . Str::slug($project->name) . '-' . Str::uuid();
    //     });
    // }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}