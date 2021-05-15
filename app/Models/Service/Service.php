<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Illuminate\Support\Facades\DB;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Service
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_type_id
 * @property string $name
 * @property bool $active
 * @property bool $validated
 * @property string $description
 * @property int $radius_action
 * @property string $distance_unit_symbol
 * @property string $photo_path
 * @property string $email
 * @property string $mobile
 * @property string $telephone
 * @property string $website
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $created_at
 *
 * @property DistanceUnit $distance_unit
 * @property BusinessVertical $business_vertical
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $service_availabilties
 * @property \Illuminate\Database\Eloquent\Collection $service_popularities
 * @property \Illuminate\Database\Eloquent\Collection $service_price_plans
 * @property \Illuminate\Database\Eloquent\Collection $service_reviews
 *
 * @package App\Models
 */
class Service extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'user_id' => 'int',
        'service_type_id' => 'int',
        'active' => 'bool',
        'validated' => 'bool',
        'radius_action' => 'int',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    protected $fillable = [
        'user_id',
        'service_type_id',
        'name',
        'active',
        'validated',
        'description',
        'radius_action',
        'distance_unit_symbol',
        'photo_path',
        'email',
        'mobile',
        'telephone',
        'website',
        'latitude',
        'longitude'
    ];

    public function distance_unit()
    {
        return $this->belongsTo(DistanceUnit::class, 'distance_unit_symbol');
    }

    public function business_vertical()
    {
        return $this->belongsTo(BusinessVertical::class, 'service_type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service_availabilties()
    {
        return $this->hasMany(ServiceAvailabilty::class);
    }

    public function service_popularities()
    {
        return $this->hasMany(ServicePopularity::class);
    }

    public function service_bookings()
    {
        return $this->hasMany(ServiceBooking::class);
    }

    public function service_reviews()
    {
        return $this->hasMany(ServiceReview::class);
    }

    public static function get_active_valid_services()
    {
        $conditions = ['active' => 1, 'validated' => 1];
        $services = static::where($conditions)->get();

        return $services;
    }

    public static function get_all_services_by_popularity_avg()
    {
        return DB::select(DB::raw("SELECT * FROM services LEFT JOIN (
	      SELECT service_id, AVG(rating) AS rating_avg 
	      FROM service_reviews
	      GROUP BY service_id
        ) AS service_reviews ON service_reviews.service_id = services.id
        WHERE active = 1 AND validated = 1
        ORDER BY rating_avg DESC"));
    }

    public static function getServicesByType($id) {
        $services_type = Service::where('service_type_id', '=', $id)->get();
        return $services_type;
    }

    public static function getAllUserServices($id) {
        $user_services = Service::where('user_id', '=', $id)->get();
        return $user_services;
    }

    public static function getServicesByKeyWord($keyword) {
        $services = Service::where('name' , 'LIKE', '%'.$keyword.'%')->get();
        return $services;
    }

    public static function getServicesByKeyWordAndType($id_type , $keyword){
        $services = Service::where('name', 'LIKE', '%'.$keyword.'%')
            ->where('service_type_id','=', $id_type)
            ->get();
        return $services;
    }

    public static function getTop3Services(){
        $services = Service::all()->take(3);
        return $services;
    }

    public static function get_service_review_avg($service_id)
    {
        $service_avg = Service::findOrFail($service_id)->service_reviews()->get()->avg('rating');

        return $service_avg;
    }

    public static function get_number_reviews_by_level($service_id, $level)
    {
        if ($level >= 1 && $level <= 5) {
            $service_avg = service::findOrFail($service_id)->service_reviews()->get()->where('rating', '=', $level)->count('rating');

            return ($service_avg != null) ? $service_avg : 0;
        } else {
            throw new \InvalidArgumentException('Level of Review Must Be Between 1 and 5!!!');
        }
    }

    public static function get_percentage_reviews_by_level($service_id, $level)
    {
        if ($level >= 1 && $level <= 5) {
            $number_level_votes = service::find($service_id)->service_reviews()->get()->where('rating', '=', $level)->count('*');
            $number_total_votes = service::find($service_id)->service_reviews()->get()->count('*');
            $service_avg = ($number_level_votes / $number_total_votes) * 100;
            return ($service_avg != null) ? $service_avg : 0;
        } else {
            throw new \InvalidArgumentException('Level of Review Must Be Between 1 and 5!!!');
        }
    }

    public static function get_services_visible() {
        $services_visible_details = DB::table('services')
            ->join('service_price_plans', 'services.id', 'service_price_plans.service_id')
            ->join('payment_plan_types', 'service_price_plans.payment_plan_type_id', 'payment_plan_types.id')
            ->select('services.*', 'service_price_plans.*', 'payment_plan_types.*')
            ->where([['services.active', true], ['services.validated', true], ['service_price_plans.active', true]])
            ->select('services.id', 'services.name', 'service_price_plans.price', 'services.latitude', 'services.longitude','services.photo_path', 'payment_plan_types.plan')
            ->get();
        return $services_visible_details;
    }
}
