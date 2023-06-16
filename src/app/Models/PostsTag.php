<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostsTag
 * 
 * @property string $post_id
 * @property string $tag_id
 * 
 * @property Post $post
 * @property Tag $tag
 *
 * @package App\Models
 */
class PostsTag extends Model
{
	protected $table = 'posts_tags';
	public $incrementing = false;
	public $timestamps = false;

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
