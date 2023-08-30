<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lesson\ViewedRequest;
use App\Http\Resources\LessonResource;
use App\Repositories\LessonRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LessonController extends Controller
{
    public function __construct(
        protected LessonRepository $lessonRepository
    ){}

    public function index(string $moduleID): AnonymousResourceCollection
    {
        return LessonResource::collection($this->lessonRepository->getLessonsByModuleId($moduleID));
    }

    public function show(string $id): LessonResource
    {
        return new LessonResource($this->lessonRepository->getLesson($id));
    }

    public function viewed(ViewedRequest $request): JsonResponse
    {
        $this->lessonRepository->markLessonViewed($request->lesson_id);
        return response()->json(['success' => true]);
    }
}
