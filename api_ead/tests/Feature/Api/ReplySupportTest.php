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

class ReplySupportTest extends TestCase
{
    use TokenTrait;

    public function test_reply_support_unauthorized()
    {
        $response = $this->postJson('/v1/supports/fake_id/replies');
        $response->assertUnauthorized();
    }

    public function test_reply_support_unprocessable()
    {
        $response = $this->postJson('/v1/supports/fake_id/replies', data: [], headers: $this->defaultHeader());
        $response->assertUnprocessable()
            ->assertJsonStructure([
                "message",
                "errors"
            ]);
    }

    public function test_reply_support_not_found()
    {
        $response = $this->postJson('/v1/supports/fake_id/replies', data: [
            'lesson_id' => 'fake_lesson_id',
            'description' => 'description of reply support'
        ], headers: $this->defaultHeader());
        $response->assertNotFound()
            ->assertJson([
                "message" => "Not Found"
            ]);
    }

    public function test_reply_support_success()
    {
        $course = Course::factory()->create();
        $module = Module::factory()->create(['course_id' => $course['id']]);
        $lesson = Lesson::factory()->create(['module_id' => $module['id']]);
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $support = Support::factory()->create([
            'user_id' => $user['id'],
            'lesson_id' => $lesson['id']
        ]);

        $response = $this->postJson("/v1/supports/{$support['id']}/replies", data: [
            'lesson_id' => $lesson['id'],
            'description' => 'description of reply support'
        ], headers: [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertCreated();
    }
}
