<?php

namespace Database\Factories;

use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReplySupport>
 */
class ReplySupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idUsers = User::all()->pluck('id')->toArray();
        $idSupports = Support::all()->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($idUsers),
            'support_id' => $this->faker->randomElement($idSupports),
            'description' => $this->faker->sentence(120)
        ];
    }
}
