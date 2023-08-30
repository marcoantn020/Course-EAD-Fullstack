<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Tests\Feature\Traits\TokenTrait;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use TokenTrait;

    public function test_get_lesson_fail()
    {
        $response = $this->getJson('/v1/modules/fake_id/lessons');
        $response->assertUnauthorized();
    }

    public function test_get_lesson_no_lessons()
    {
        $response = $this->getJson('/v1/modules/fake_id/lessons', headers: $this->defaultHeader());

        $response->assertOk()
            ->assertJsonStructure(['data'])
            ->assertJsonCount(0, 'data');
    }

    public function test_get_lesson_by_module_id_success()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        Lesson::factory(10)->create(['module_id' => $module['id']]);
        $response = $this->getJson("/v1/modules/{$module['id']}/lessons", headers: $this->defaultHeader());

        $response->assertOk()
            ->assertJsonStructure(['data'])
            ->assertJsonCount(10, 'data');
    }

    public function test_get_lesson_by_id_fail()
    {
        $response = $this->getJson("/v1/lessons/fake_id");

        $response->assertUnauthorized()
            ->assertJsonStructure(['message']);
    }

    public function test_get_lesson_by_id_not_found()
    {
        $response = $this->getJson("/v1/lessons/fake_id", headers: $this->defaultHeader());

        $response->assertNotFound()
            ->assertJson(['message' => 'Not Found']);
    }

    public function test_get_lesson_by_success()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);

        $response = $this->getJson("/v1/lessons/{$lesson['id']}", headers: $this->defaultHeader());

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                    'video'
                ]
            ]);
    }

    public function test_mark_lesson_with_viewed()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);

        $response = $this->postJson("/v1/lessons/viewed",
            data: ['lesson_id' => $lesson['id']],
            headers: $this->defaultHeader()
        );

        $response->assertOk()
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_mark_lesson_with_viewed_unprocessable()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);

        $response = $this->postJson("/v1/lessons/viewed",
            data: [],
            headers: $this->defaultHeader()
        );

        $response->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "lesson_id"
                ]
            ]);
    }

    public function test_mark_lesson_with_viewed_unauthorized()
    {

        $response = $this->postJson("/v1/lessons/viewed",
            data: []
        );

        $response->assertUnauthorized();
    }
}
