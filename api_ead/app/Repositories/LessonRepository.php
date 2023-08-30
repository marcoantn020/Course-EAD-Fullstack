<?php

namespace App\Repositories;


use App\Models\Lesson;
use App\Models\Module;
use App\Repositories\Traits\GetUserAuthTrait;

class LessonRepository
{
    use GetUserAuthTrait;
    public function __construct(
        protected Lesson $lesson
    ){}

    public function getLessonsByModuleId(string $moduleID)
    {
        return $this->lesson
            ->with('supports.replies')
            ->where('module_id', '=', $moduleID)
            ->get();
    }

    public function getLesson(string $id)
    {
        return $this->lesson->findOrFail($id);
    }

    public function markLessonViewed(string $lesson_id)
    {
        $user = $this->getUserAuth();

        if($view = $user->views()->where('lesson_id', '=', $lesson_id)->first()) {
            return $view->update([
                'qty' => $view->qty + 1
            ]);
        }

        return $user
            ->views()
            ->create([
                'lesson_id' => $lesson_id
            ]);
    }


}
