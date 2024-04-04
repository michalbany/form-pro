<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['project_id', 'parent_id', 'name'];

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

    public function scopeParents()
    {
        return $this->whereNull('parent_id');
    }

    public function textFields()
    {
        return $this->hasMany(TextField::class);
    }

    public function content()
    {
        return $this->hasMany(PageComponent::class);
    }
}