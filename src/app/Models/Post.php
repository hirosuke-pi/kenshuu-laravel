<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * 
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Image[] $images
 * @property Collection|Tag[] $tags
 *
 * @package App\Models
 */
class Post extends Model
{
	use SoftDeletes;
	protected $table = 'posts';
	public $incrementing = false;

	protected $fillable = [
		'user_id',
		'title',
		'body'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function images()
	{
		return $this->hasMany(Image::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'posts_tags');
	}
}
