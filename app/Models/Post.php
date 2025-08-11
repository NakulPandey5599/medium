<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
   use  HasFactory;

   protected $guarded = [];

   public function user()
   {
      return $this->belongsTo(User::class);
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
}
