<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseRepository
{
    public function __construct(
        protected Course $course
    ){}

    public function getAllCourses(): Collection|array
    {
        return $this->course->with('modules.lessons.views')->get();
    }

    public function getCourse(string $id): Model|Collection|Builder|array|null
    {
        return $this->course->with('modules.lessons.views')->findOrFail($id);
    }
}
