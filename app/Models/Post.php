<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Comment;

class Post extends Model
{
   use  HasFactory;

   protected $guarded = [];

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

      public function imageUrl()
   {
      // If image column has just the file name
      return asset('storage/' . $this->image);

      // Or, if you store full path in DB
      // return asset($this->image);
   }

   public function category()
   {
      return $this->belongsTo(Category::class);
   }
}
