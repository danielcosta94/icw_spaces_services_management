<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 02 Oct 2017 13:43:15 +0000.
 */

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\DB;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceBooking
 *
 * @property int $id
 * @property int $user_id_client
 * @property int $space_id
 * @property string $space_price_plan
 * @property string $status_booking
 * @property string $payment_stripe_id
 * @property \Carbon\Carbon $date_reservation
 * @property float $price_unit
 * @property int $duration
 * @property \Carbon\Carbon $start_datetime
 * @property \Carbon\Carbon $end_datetime
 * @property string $currency
 * @property \Carbon\Carbon $date_cancellation
 *
 * @property Space $space
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $space_booking_availabilities
 * @property \Illuminate\Database\Eloquent\Collection $space_booking_details
 * @property \Illuminate\Database\Eloquent\Collection $space_reserved_extras
 *
 * @package App\Models
 */
class SpaceBooking extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'user_id_client' => 'int',
        'space_id' => 'int',
        'price_unit' => 'float',
        'duration' => 'int'
    ];

    protected $dates = [
        'date_reservation',
        'start_datetime',
        'end_datetime',
        'date_cancellation'
    ];

    protected $fillable = [
        'user_id_client',
        'space_id',
        'space_price_plan',
        'status_booking',
        'payment_stripe_id',
        'date_reservation',
        'price_unit',
        'duration',
        'start_datetime',
        'end_datetime',
        'currency',
        'date_cancellation'
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_client');
    }

    public function space_booking_availabilities()
    {
        return $this->hasMany(SpaceBookingAvailability::class, 'space_reservation_id');
    }

    public function space_booking_details()
    {
        return $this->hasMany(SpaceBookingDetail::class);
    }

    public function space_reserved_extras()
    {
        return $this->hasMany(SpaceReservedExtra::class, 'space_reservation_id');
    }

    public static function getAllMyBookings($user_id)
    {
        $user_spaces = SpaceBooking::where('user_id_client', $user_id);

        return $user_spaces;
    }

    public static function getAllBookingsMySpaces($user_id)
    {
        $users_bookings_my_spaces_details = SpaceBooking::join('spaces', 'space_bookings.space_id', 'spaces.id')
            ->where('spaces.user_id', $user_id)
            ->select('space_bookings.*');

        return $users_bookings_my_spaces_details;
    }
}
