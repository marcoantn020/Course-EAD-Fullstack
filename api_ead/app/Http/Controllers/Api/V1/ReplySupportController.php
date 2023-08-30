<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplySupport\CreateReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplyRepository;

class ReplySupportController extends Controller
{
    public function __construct(
        protected ReplyRepository $replyRepository
    ){}

    public function createReply(string $supportID, CreateReplySupportRequest $request): ReplySupportResource
    {
        $reply = $this->replyRepository->createReplyToSupportId($supportID, $request->validated());
        return new ReplySupportResource($reply);
    }
}
