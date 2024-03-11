<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = ['project_id', 'parent_id', 'name'];

    // protected static function boot()
    // {
    //     // generovani URL při vytvoření nebo úpravě stránky
    //     parent::boot();

    //     static::creating(function ($page) {
    //         $page->slug = Str::slug($page->name) . '-' . Str::uuid();
    //     });

    //     static::updating(function ($page) {
    //         $page->slug = Str::slug($page->name) . '-' . Str::uuid();
    //     });
    // }
    

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function textFields()
    {
        return $this->hasMany(TextField::class);
    }
}