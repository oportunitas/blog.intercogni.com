<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blogs';

	protected $fillable = [
		'title',
		'body',
		'user_email',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_email', 'email');
	}

	public function votes()
	{
		return $this->hasMany(Vote::class, 'blog_id', 'id');
	}

	public function getVoteCountAttribute()
	{
		return $this->votes()->sum('vote_type');
	}
}