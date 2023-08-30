<?php

namespace App\Repositories;


use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

class ModuleRepository
{
    public function __construct(
        protected Module $module
    ){}

    public function getModulesByCourseById(string $courseID): Collection|array
    {
        return $this->module
            ->with('lessons.views')
            ->where('course_id', '=', $courseID)
            ->get();
    }
}
