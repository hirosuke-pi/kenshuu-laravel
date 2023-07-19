<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @property string $id
 * @property string $tag_name
 *
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class Tag extends Model
{
	protected $table = 'tags';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
        'id',
		'tag_name'
	];

	public function posts()
	{
		return $this->belongsToMany(Post::class, 'posts_tags');
	}
}
