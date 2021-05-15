<?php

namespace App\Http\Middleware;

use App\Models\UserType;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class WorkerAuthentication
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * Create a new filter instance
     *
     * @param Guard $auth
     */
    function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user_type_id = $this->auth->user()->user_type_id;
            $user_type_details = UserType::find($user_type_id);
            $user_type_name = $user_type_details->user_type;

            if($user_type_name != 'worker')
            {
                return redirect()->guest('/');
            }
            return $next($request);
        } catch (\Exception $exception) {
            return redirect()->guest('/');
        }
    }
}
