<?php

namespace App\Repositories\Traits;


use Illuminate\Contracts\Auth\Authenticatable;

trait GetUserAuthTrait
{
    public function getUserAuth(): ?Authenticatable
    {
        return auth()->user();
    }
}
