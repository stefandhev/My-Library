<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_date',
        'genre_id',
        'description',
        'image_url',
        'status',
    ];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    protected $casts = ['published_date' => 'date'];

    public function getImageUrlAttribute() {
        if ($this->attributes['image_url'] && file_exists(public_path($this->attributes['image_url']))) {
            return asset($this->attributes['image_url']);
        }
        elseif (
            $this->attributes['image_url'] && file_exists(storage_path('app/public/' . $this->attributes['image_url']))
        ) {
            return asset('storage/' . $this->attributes['image_url']);
        }

        return asset('image_default.jpg');
    }


    public function getFullTitleAttribute() {
        return "{$this->title} by {$this->author}";
    }

    public function scopeOfGenre($query, $genre_id) {
        return $query->where('genre_id', $genre_id);
    }

    
}
