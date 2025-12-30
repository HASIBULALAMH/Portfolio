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


    //automatic slug generation
    public static function boot(){
        parent::boot();

        static::creating(function ($project){
            if (empty($project->slug)){
                $project->slug=Str::slug($project->title);
            }
        });
    }

    //schope for filtered projects with published

    public function scopePublished($quary){
        return $quary->where('is_published', true);
    }

     //schope for filtered projects with featured

    public function scopeFeatured($quary){
        return $quary->where('is_featured', true);
    }

      //schope for filtered projects with ordered
    public function schopeOrdered($quary){
        return $quary->where('order', 'asc');
    }

}
