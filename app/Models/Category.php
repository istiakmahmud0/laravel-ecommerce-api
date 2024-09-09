<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['category_name'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('category_images')
            ->singleFile(); // Only one image per category, remove if you want multiple images
    }
}
