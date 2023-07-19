<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Class User
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string|null $profile_img_path
 * @property Carbon $created_at
 * @property string|null $deleted_at
 *
 * @property Collection|Post[] $posts
 *
 * @package App\Models
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use HasUuids, HasFactory, Authenticatable, Authorizable;

	use SoftDeletes;
	protected $table = 'users';
	public $incrementing = false;
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'email',
		'password',
		'profile_img_path'
	];

	public function posts()
	{
		return $this->hasMany(Post::class);
	}
}
