<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasProfilePhoto;

class Profile extends Model
{
    use HasFactory, HasProfilePhoto;

    /**
     * Database table name
     *
     * @var string
     */
    protected $table = 'profile';

    /**
     * @inheritdoc
     */
    public function getRouteKeyName()
    {
        return 'user_id';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'fullname',
        'mobile_number',
        'photo'
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected $guarded = [];

    /**
     * Function to update Profile and User models
     *
     * @return object|boolean
     */
    public function modify($data)
    {
        $user_data = ['email' => $data['email']];
        unset($data['email']);

        $user = User::where('id', $this->user_id)->first();

        return ($this->update($data) && $user->update($user_data)) ? true : false;
    }

    /**
     * DB Relational connection from Profile -> User model
     *
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
