<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_email',
        'blog_id',
        'vote_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_email', '=', $this->getAttribute('user_email'))
            ->where('blog_id', '=', $this->getAttribute('blog_id'));

        return $query;
    }
}