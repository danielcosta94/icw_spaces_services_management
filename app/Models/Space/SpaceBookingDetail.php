<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SpaceBookingDetail
 *
 * @property int $id
 * @property int $space_booking_id
 * @property int $hour
 * @property \Carbon\Carbon $date
 * @property string $status_booking
 * @property \Carbon\Carbon $date_cancellation
 *
 * @property SpaceBooking $space_booking
 *
 * @package App\Models
 */
class SpaceBookingDetail extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'space_booking_id' => 'int',
        'hour' => 'int'
    ];

    protected $dates = [
        'date',
        'date_cancellation'
    ];

    protected $fillable = [
        'space_booking_id',
        'hour',
        'date'
    ];

    public function space_booking()
    {
        return $this->belongsTo(SpaceBooking::class);
    }

    public static function getSpaceBookingDetailsByDate($space_id, $date)
    {
        $spaces_booking_details_date = DB::table('space_booking_details')
            ->join('space_bookings', 'space_booking_details.space_booking_id', 'space_bookings.id')
            ->where([['space_bookings.space_id', $space_id], ['space_booking_details.date', $date]])
            ->get();
        return $spaces_booking_details_date;
    }

    public static function getSpaceBookingDetailsByDateHour($space_id, $date, $start_hour, $end_hour)
    {
        $spaces_booking_details_date = DB::table('space_booking_details')
            ->join('space_bookings', 'space_booking_details.space_booking_id', 'space_bookings.id')
            ->where([['space_bookings.space_id', $space_id], ['space_booking_details.date', $date]])
            ->whereBetween('hour', [$start_hour, $end_hour])
            ->get();
        return $spaces_booking_details_date;
    }

    public static function getAllBookingDetails($booking_id)
    {
        $booking_details = SpaceBookingDetail::where('space_booking_id', $booking_id);

        return $booking_details;
    }
}
