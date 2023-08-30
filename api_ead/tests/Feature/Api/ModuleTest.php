<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\Feature\Traits\TokenTrait;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    use TokenTrait;

    public function test_search_modules_of_courses_by_id_course_fail()
    {
        $response = $this->getJson('/v1/courses/fake_id/modules');

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_search_modules_of_courses_by_id_course_no_results()
    {
        $response = $this->getJson('/v1/courses/fake_id/modules', headers: $this->defaultHeader());
        $response->assertOk();
        $response->assertJsonMissing(['data']);
    }

    public function test_search_modules_of_courses_by_id_course_success()
    {
        $course = Course::factory()->create();
        Module::factory(10)->create(['course_id' => $course['id']]);

        $response = $this->getJson("/v1/courses/{$course['id']}/modules", headers: $this->defaultHeader());

        $response->assertOk();
        $response->assertJsonStructure([
            'data'
        ]);
        $response->assertJsonCount(10, 'data');
    }
}
