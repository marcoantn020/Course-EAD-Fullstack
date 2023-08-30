<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Support\CreateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupportController extends Controller
{
    public function __construct(
        protected SupportRepository $supportRepository
    ){}

    public function index(Request $request): AnonymousResourceCollection
    {
        $supports = $this->supportRepository->getSupports($request->all());
        return SupportResource::collection($supports);
    }

    public function mySupport(Request $request): AnonymousResourceCollection
    {
        $supports = $this->supportRepository->getMySupport($request->all());
        return SupportResource::collection($supports);
    }

    public function store(CreateSupportRequest $request): SupportResource
    {
        $support = $this->supportRepository->createNewSupport($request->validated());
        return new SupportResource($support);
    }
}
