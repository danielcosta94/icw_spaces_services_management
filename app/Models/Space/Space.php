<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 27 Sep 2017 13:58:21 +0000.
 */

namespace App\Models;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Space
 *
 * @property int $id
 * @property int $user_id
 * @property int $space_type_id
 * @property string $name
 * @property bool $active
 * @property bool $validated
 * @property int $business_vertical_id
 * @property int $capacity
 * @property string $description
 * @property string $email
 * @property string $telephone_number
 * @property string $website
 * @property float $latitude
 * @property float $longitude
 * @property \Carbon\Carbon $created_at
 *
 * @property BusinessVertical $business_vertical
 * @property SpaceType $space_type
 * @property User $user
 * @property \Illuminate\Database\Eloquent\Collection $space_availabilties
 * @property \Illuminate\Database\Eloquent\Collection $space_extras
 * @property \Illuminate\Database\Eloquent\Collection $space_extras_customs
 * @property \Illuminate\Database\Eloquent\Collection $space_photos
 * @property \Illuminate\Database\Eloquent\Collection $space_popularities
 * @property \Illuminate\Database\Eloquent\Collection $space_price_plans
 * @property \Illuminate\Database\Eloquent\Collection $space_reviews
 *
 * @package App\Models
 */
class Space extends Eloquent
{
    public $timestamps = false;

    protected $casts = [
        'user_id' => 'int',
        'space_type_id' => 'int',
        'active' => 'bool',
        'validated' => 'bool',
        'business_vertical_id' => 'int',
        'capacity' => 'int',
        'latitude' => 'float',
        'longitude' => 'float'
    ];

    protected $fillable = [
        'user_id',
        'space_type_id',
        'name',
        'active',
        'validated',
        'business_vertical_id',
        'capacity',
        'description',
        'email',
        'telephone_number',
        'website',
        'latitude',
        'longitude'
    ];

    public function business_vertical()
    {
        return $this->belongsTo(BusinessVertical::class);
    }

    public function space_type()
    {
        return $this->belongsTo(SpaceType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function space_availabilties()
    {
        return $this->hasMany(SpaceAvailabilty::class);
    }

    public function space_extras()
    {
        return $this->hasMany(SpaceExtra::class);
    }

    public function space_extras_customs()
    {
        return $this->hasMany(SpaceExtrasCustom::class);
    }

    public function space_photos()
    {
        return $this->hasMany(SpacePhoto::class);
    }

    public function space_price_plans()
    {
        return $this->hasMany(SpacePricePlan::class);
    }

    public function space_popularities()
    {
        return $this->hasMany(SpacePopularity::class);
    }

    public function space_bookings()
    {
        return $this->hasMany(SpaceBooking::class);
    }

    public function space_reviews()
    {
        return $this->hasMany(SpaceReview::class);
    }


    public static function getSpacePricePlansDetails($space_id) {
        $table = DB::table('payment_plan_types')
            ->join('space_price_plans', 'payment_plan_types.id', '=', 'space_price_plans.payment_plan_type_id')
            ->select('payment_plan_types.*', 'space_price_plans.*')
            ->where('space_id', '=', $space_id)
            ->get();

        return $table;
    }

    public static function get_space_review_avg($space_id)
    {
        $space_avg = Space::findOrFail($space_id)->space_reviews()->get()->avg('rating');

        return $space_avg;
    }

    public static function get_number_reviews_by_level($space_id, $level)
    {
        if ($level >= 1 && $level <= 5) {
            $space_avg = Space::findOrFail($space_id)->space_reviews()->get()->where('rating', '=', $level)->count('rating');

            return ($space_avg != null) ? $space_avg : 0;
        } else {
            throw new \InvalidArgumentException('Level of Review Must Be Between 1 and 5!!!');
        }
    }

    public static function get_percentage_reviews_by_level($space_id, $level)
    {
        if ($level >= 1 && $level <= 5) {
            $number_level_votes = Space::findOrFail($space_id)->space_reviews()->get()->where('rating', '=', $level)->count('*');
            $number_total_votes = Space::findOrFail($space_id)->space_reviews()->get()->count('*');
            $space_avg = ($number_level_votes / $number_total_votes) * 100;
            return ($space_avg != null) ? $space_avg : 0;
        } else {
            throw new \InvalidArgumentException('Level of Review Must Be Between 1 and 5!!!');
        }
    }

    public static function get_all_spaces_by_popularity_avg()
    {
        return DB::select(DB::raw("SELECT * FROM spaces LEFT JOIN (
	      SELECT space_id, AVG(rating) AS rating_avg 
	      FROM space_reviews
	      GROUP BY space_id
        ) AS spaces_ratings ON spaces_ratings.space_id = spaces.id
        WHERE active = 1 AND validated = 1
        ORDER BY rating_avg DESC"));
    }

    public static function get_spaces_visible(Request $request) {
        $space_type_id = $request->get('space_type_id');
        if(isset($space_type_id) && $space_type_id != "all") {
            $spaces_visible_details = Space::join('space_photos', 'spaces.id', 'space_photos.space_id')
                ->join('space_price_plans', 'spaces.id', 'space_price_plans.space_id')
                ->join('payment_plan_types', 'space_price_plans.payment_plan_type_id', 'payment_plan_types.id')
                ->select('spaces.*', 'space_photos.*', 'space_price_plans.*', 'payment_plan_types.*')
                ->where([['spaces.active', true], ['spaces.validated', true], ['space_photos.photo_type', 'main'], ['space_price_plans.active', true], ['spaces.space_type_id', $space_type_id]])
                ->select('spaces.id', 'spaces.name', 'space_price_plans.price', 'spaces.capacity', 'spaces.latitude', 'spaces.longitude', 'space_photos.path', 'payment_plan_types.plan')
                ->get();
        } else {
            $spaces_visible_details = Space::join('space_photos', 'spaces.id', 'space_photos.space_id')
                ->join('space_price_plans', 'spaces.id', 'space_price_plans.space_id')
                ->join('payment_plan_types', 'space_price_plans.payment_plan_type_id', 'payment_plan_types.id')
                ->select('spaces.*', 'space_photos.*', 'space_price_plans.*', 'payment_plan_types.*')
                ->where([['spaces.active', true], ['spaces.validated', true], ['space_photos.photo_type', 'main'], ['space_price_plans.active', true]])
                ->select('spaces.id', 'spaces.name', 'space_price_plans.price', 'spaces.capacity', 'spaces.latitude', 'spaces.longitude', 'space_photos.path', 'payment_plan_types.plan')
                ->get();
        }
        return $spaces_visible_details;
    }

    public static function getAllVisibleSpaces($space_type_id = null) {
        if(isset($space_type_id) && $space_type_id != "all") {
            $spaces = Space::where([['active', true], ['validated', true], ['space_type_id', $space_type_id]]);
        } else {
            $spaces = Space::where([['active', true], ['validated', true]]);
        }
        return $spaces;
    }

    public static function getAllUserSpaces($user_id) {
        $user_spaces = Space::where('user_id', '=', $user_id);

        return $user_spaces;
    }

    public static function set_space_activation($space_id, $active) {
        Space::findOrFail($space_id)->update(['active' => $active]);
    }

    public static function set_space_validation($space_id, $validated) {
        Space::findOrFail($space_id)->update(['validated' => $validated]);
    }
}
