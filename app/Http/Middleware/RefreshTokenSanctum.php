<?php

namespace App\Http\Middleware;

use App\Models\ProfileAbility;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Throwable;

class RefreshTokenSanctum
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            $authHeader = $request->header('Authorization') ?? $request->headers->get('authorization');

            if (! $authHeader || ! Str::startsWith($authHeader, 'Bearer ')) {
                return $response;
            }

            $token = substr($authHeader, 7);
            if (! $token) {
                return $response;
            }

            // Use the static finder for PersonalAccessToken
            $personalAccessToken = PersonalAccessToken::findToken($token);

            if (! $personalAccessToken) {
                return $response;
            }

            // If token needs refresh (older than 5 minutes), update abilities
            if ($this->needsRefresh($personalAccessToken)) {
                $this->updateTokenAbilities($personalAccessToken);
            }

            // Ensure the response contains the Authorization header in Bearer format
            $response->headers->set('Authorization', 'Bearer ' . $token);
        } catch (Throwable $e) {
            // don't break the response on any unexpected error
            logger()->warning('RefreshTokenSanctum error: ' . $e->getMessage());
        }

        return $response;
    }

    private function needsRefresh($token): bool
    {
        // refresh when token wasn't updated in the last 5 minutes
        return $token->updated_at->lt(now()->subMinutes(5));
    }

    private function updateTokenAbilities($token)
    {
        $user = auth()->user();

        if (! $user || ! isset($user->profile->id)) {
            return;
        }

        $abilities = $this->getUserAbilities((int) $user->profile->id);
        $token->abilities = $abilities;
        $token->save();
    }

    /**
     * Retorna abilities.slug de abilities com base no id passado como parâmetro.
     */
    public function getUserAbilities(int $id)
    {
        return ProfileAbility::select('abilities.slug as abilities')
            ->join('abilities', 'abilities.id', '=', 'profile_abilities.ability_id')
            ->where('profile_abilities.profile_id', '=', $id)
            ->pluck('abilities')
            ->toArray();
    }
}