<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Repositories\CourseRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CourseController extends Controller
{
    public function __construct(
        protected CourseRepository $courseRepository
    ){}

    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection($this->courseRepository->getAllCourses());
    }

    public function show(string $id): CourseResource
    {
        return new CourseResource($this->courseRepository->getCourse($id));
    }
}
