<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idsModule = Module::all()->pluck('id')->toArray();
        $name = $this->faker->unique()->name();
        return [
            'name' => $name,
            'url' => Str::slug($name),
            'video' => 'https://www.youtube.com/embed/KuzeyRr74xM',
            'module_id' => $this->faker->randomElement($idsModule),
        ];
    }
}
