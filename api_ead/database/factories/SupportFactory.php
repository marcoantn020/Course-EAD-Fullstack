<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $lessonIds = Lesson::all()->pluck('id')->toArray();
        $userIds = User::all()->pluck('id')->toArray();
        $enum = ["pending","waiting","concluded"];
        return [
            'lesson_id' => $this->faker->randomElement($lessonIds),
            'user_id' => $this->faker->randomElement($userIds),
            'status' => $this->faker->randomElement($enum),
            'description' => $this->faker->sentence(100)
        ];
    }
}
