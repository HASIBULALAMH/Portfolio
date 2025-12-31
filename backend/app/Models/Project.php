<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'technologies',
        'live_url',
        'github_url',
        'is_featured',
        'order',
        'is_published',
    ];

    protected $casts = [
        'technologies'=>'array',
        'is_featured'=>'boolean',
        'is_published'=>'boolean',
    ];
    // get image attribute as full URL
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    //automatic slug generation
    public static function boot(){
        parent::boot();

        static::creating(function ($project){
            if (empty($project->slug)){
                $project->slug=Str::slug($project->title);
            }
        });
    }
    // get only published projects
   public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
        // get only featured projects
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // get projects ordered by 'order' field ascending
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

}
