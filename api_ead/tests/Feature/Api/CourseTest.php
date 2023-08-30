<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use Tests\Feature\Traits\TokenTrait;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use TokenTrait;

    public function test_get_all_courses_fail()
    {
        $response = $this->getJson('/v1/courses');
        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_get_all_courses_success()
    {
        Course::factory(5)->create();
        $response = $this->getJson('/v1/courses', headers: $this->defaultHeader());

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'description',
                    'image'
                ]
            ]
        ]);
        $response->assertJsonCount(5, 'data');
    }

    public function test_get_courses_by_id_fail()
    {
        $response = $this->getJson('/v1/courses/fake_id');

        $response->assertUnauthorized();
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_get_courses_by_id_not_found()
    {
        $response = $this->getJson("/v1/courses/fake_id", headers: $this->defaultHeader());
        $response->assertNotFound();
        $response->assertJson([
            'message' => 'Not Found'
        ]);
    }

    public function test_get_courses_by_id_success()
    {
        $course = Course::factory()->create();
        $response = $this->getJson("/v1/courses/{$course['id']}", headers: $this->defaultHeader());

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                    'id',
                    'name',
                    'description',
                    'image'
            ]
        ]);
    }
}
