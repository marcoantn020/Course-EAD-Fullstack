<?php

namespace Tests\Feature\Traits;

use App\Models\User;

trait TokenTrait
{
    public function getToken()
    {
        $user = User::factory()->create();
        return $user->createToken('test')->plainTextToken;
    }

    public function defaultHeader(): array
    {
        return [
            'Authorization' => "Bearer {$this->getToken()}"
        ];
    }
}
