<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App;

use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\ServiceReview;
use App\Models\Space;
use App\Models\SpaceBooking;
use App\Models\SpaceReview;
use App\Models\UserAction;
use App\Models\UserType;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property bool $active
 * @property string $mobile_number
 * @property string $telephone_number
 * @property string $city
 * @property string $password
 * @property int $user_type_id
 * @property string $linkedin_profile
 * @property string $facebook_profile
 * @property string $stripe_id
 * @property string $stripe_active
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \App\UserType $user_type
 * @property \Illuminate\Database\Eloquent\Collection $service_bookings
 * @property \Illuminate\Database\Eloquent\Collection $service_reviews
 * @property \Illuminate\Database\Eloquent\Collection $services
 * @property \Illuminate\Database\Eloquent\Collection $space_bookings
 * @property \Illuminate\Database\Eloquent\Collection $space_reviews
 * @property \Illuminate\Database\Eloquent\Collection $spaces
 * @property \Illuminate\Database\Eloquent\Collection $user_actions
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    protected $casts = [
        'active' => 'bool',
        'user_type_id' => 'int',
        'stripe_active' => 'bool',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'active',
        'mobile_number',
        'telephone_number',
        'city',
        'password',
        'user_type_id',
        'linkedin_profile',
        'facebook_profile',
        'stripe_id',
        'stripe_active',
        'remember_token'
    ];

    public function user_type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function service_bookings()
    {
        return $this->hasMany(ServiceBooking::class, 'user_client_id');
    }

    public function service_reviews()
    {
        return $this->hasMany(ServiceReview::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function space_bookings()
    {
        return $this->hasMany(SpaceBooking::class, 'user_id_client');
    }

    public function space_reviews()
    {
        return $this->hasMany(SpaceReview::class);
    }

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }

    public function user_actions()
    {
        return $this->hasMany(UserAction::class);
    }

    public static function getAllUsersExceptAdmins()
    {
        $users_details = DB::table('users')
            ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select('users.*', 'user_types.user_type', 'user_types.description')
            ->where('user_type', '<>', 'admin')
            ->paginate(10);

        return $users_details;
    }
}