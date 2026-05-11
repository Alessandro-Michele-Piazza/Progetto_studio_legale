<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Redirect newly registered users to the email verification notice screen.
     */
    public function toResponse($request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect()->route('verification.notice');
    }
}
