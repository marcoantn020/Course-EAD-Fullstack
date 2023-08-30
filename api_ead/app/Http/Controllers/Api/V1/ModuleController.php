<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{
    public function __construct(
        protected ModuleRepository $moduleRepository
    ){}

    public function index(string $courseID): AnonymousResourceCollection
    {
        return ModuleResource::collection($this->moduleRepository->getModulesByCourseById($courseID));
    }
}
