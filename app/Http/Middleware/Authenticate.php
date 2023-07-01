<?php

namespace App\Http\Middleware;

use App\Models\UserActive;
use Closure;
use Exception;
use JWTAuth;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }

    public function handle($request, Closure $next, ...$roles)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Session Expired!',], 401);
        }

        if (!$user) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Session Expired!',], 401);
        }

        if (!empty($roles) && !in_array($user->authorization_level, $roles)) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'authorization level not allowed',], 401);
        }

        if (!empty($roles) && in_array('verified', $roles)) {
            $userActive = UserActive::find($user->id_user_active);

            if ($userActive) {
                $requiredFields = ($user->authorization_level == 1)
                    ? ['phone_number', 'email', 'id_card', 'tax_registration_number', 'user_bank']
                    : ['phone_number', 'email', 'id_card', 'tax_registration_number', 'user_bank', 'user_business'];

                $missingFields = array_filter($requiredFields, fn($field) => $userActive->$field == 0);

                if (!empty($missingFields)) {
                    return response()->json([
                        'error' => 'Unauthorized',
                        'message' => 'Authorization not verified, please contact us!'
                    ], 401);
                }

            }
        }

        return $next($request);
    }
}
