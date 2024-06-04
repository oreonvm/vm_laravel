<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'slug', 'content', 'email', 'category_id', 'views', 'image', 'updated_at'];

    /**
     * Получить КАТЕГОРИЮ, которому принадлежит ПОСТ.
     */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Получить КАТЕГОРИЮ, которому принадлежат ПОСТЫ.
     */
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getPostDate()
    {
        // Carbon::parse($this->created_at)->diffForHumans();
        return  date("d.m.Y ", strtotime($this->created_at));
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function deleteImage(Request $request, $image = false)
    {
        if ($request->hasFile('image')) {
            Storage::delete($image);
        }
    }

    public function scopeLike(Builder $query,  $s)
    {
        return $query->where('title', 'like', "%{$s}%");
    }
}
