<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Image
 * 
 * @property string $id
 * @property string $post_id
 * @property bool $thumbnail_flag
 * @property string $file_path
 * @property string|null $deleted_at
 * 
 * @property Post $post
 *
 * @package App\Models
 */
class Image extends Model
{
	use SoftDeletes;
	protected $table = 'images';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'thumbnail_flag' => 'bool'
	];

	protected $fillable = [
		'post_id',
		'thumbnail_flag',
		'file_path'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
