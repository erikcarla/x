<?php

namespace App\Models;

use Carbon\Carbon;
use Auth;

class Article extends BaseModel
{
    protected $fillable = ['title', 'body', 'media_id', 'user_id', 'published', 'publish_date'];

    public function user()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User');
    }

    public function media()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Media');
    }

    /*
     * Scopes
     */

    public function scopeByUser($query, $id = null)
    {
        $id = $id ?: Auth::user()->id;
        return $query->where('articles.user_id', $id);
    }

    public function scopePublished($query)
    {
        return $query->where('articles.published', true);
    }

    public function scopeOrderByPublished($query)
    {
        return $query
            ->orderBy('articles.published', 'DESC')
            ->orderBy('articles.publish_date', 'DESC');
    }
}
