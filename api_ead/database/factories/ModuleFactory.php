<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idsCourses = Course::all()->pluck('id')->toArray();
        return [
            'name' => $this->faker->word(),
            'course_id' => $this->faker->randomElement($idsCourses),
        ];
    }
}
