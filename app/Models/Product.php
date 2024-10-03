<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia
{
<<<<<<< HEAD
    use HasFactory, InteractsWithMedia, HasSlug;
    protected $guarded  = [];

    /**
     * Generating image in the media
     */    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images')
            ->singleFile();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
=======
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'price',
        'quantity',
        'sku',
        'rating',
        'short_description',
        'long_description',
    ];
>>>>>>> c28d0c883365f98345e844756e93d5dd128c2337
}
