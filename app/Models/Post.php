<?php

namespace App\Models;

use App\Models\Comment;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia

{
   use  HasFactory;
   use InteractsWithMedia;
   use HasSlug;

   protected $guarded = [];

   public function registerMediaConversions(?Media $media = null): void
   {
    $this
        ->addMediaConversion('preview')
        ->width(400);
        $this
        ->addMediaConversion('large')
        ->width(1200);
        
   }
   public function registerMediaCollections(): void
   {
       $this
           ->addMediaCollection('default')
           ->singleFile();
   }

   public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function comments()
   {
      return $this->hasMany(Category::class);
   }


   public function readTime()
   {
      $words = str_word_count($this->content);
      $minutes = ceil($words / 100);
      return max($minutes, 1);
   }

   function created_at() {
      return $this->created_at->diffForHumans();
   }

      public function imageUrl($conversionName = '')
   {
       $media = $this->getFirstMedia();
        if (!$media) {
            return null;
        }
        if ($media->hasGeneratedConversion($conversionName)) {
            return $media->getUrl($conversionName);
        }
        return $media->getUrl();
   }

   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function claps()
   {
       return $this->hasMany(Clap::class);
   }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


}
