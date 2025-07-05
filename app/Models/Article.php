<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "slug",
        "content",
        "excerpt",
        "featured_image_url",
        "status",
        "views_count",
        "published_at",
    ];
}
