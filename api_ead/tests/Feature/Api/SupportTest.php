<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TokenTrait;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use TokenTrait;

    public function test_supports_user_auth_unauthorized()
    {
        $response = $this->getJson('/v1/my-supports');
        $response->assertUnauthorized();
    }

    public function test_get_my_supports_user_auth_success()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        Support::factory(10)->create([
            'user_id' => $user['id'],
            'lesson_id' => $lesson['id']
        ]);

        $response = $this->getJson('/v1/my-supports', headers: [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertOk()
            ->assertJsonCount(10, 'data');
    }

    public function test_get_supports_user_auth_success()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        Lesson::factory()->create(['module_id' => $module['id']]);

        Support::factory(38)->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->getJson('/v1/supports', headers: $this->defaultHeader());

        $response->assertOk()
            ->assertJsonCount(38, 'data');
    }

    public function test_get_supports_user_auth_success_by_lesson_id()
    {
        $module = Module::factory()->create(['course_id' => Course::factory()->create()]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);

        Support::factory()->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->getJson("/v1/supports?lesson_id={$lesson['id']}", headers: $this->defaultHeader());

        $response->assertOk();
    }

    public function test_get_supports_user_auth_success_by_status()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        Lesson::factory()->create(['module_id' => $module['id']]);

        Support::factory(30)->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->getJson("/v1/supports?status=pending", headers: $this->defaultHeader());

        $response->assertOk();
    }

    public function test_get_supports_user_auth_success_by_description()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        Lesson::factory()->create(['module_id' => $module['id']]);

        Support::factory(10)->create([
            'user_id' => User::factory()->create()
        ]);

        $response = $this->getJson("/v1/supports?description=a", headers: $this->defaultHeader());

        $response->assertOk();
    }

    public function test_create_new_support()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);

        $response = $this->postJson('/v1/supports', data: [
            "lesson_id" => $lesson['id'],
            "description" => "uma breve descricao de teste"
        ], headers: $this->defaultHeader());

        $response->assertCreated();
    }

    public function test_create_new_support_unprocessable()
    {
        $response = $this->postJson('/v1/supports', data: [], headers: $this->defaultHeader());
        $response->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors"
            ]);
    }
}
