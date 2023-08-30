<?php

namespace App\Repositories;


use App\Models\ReplySupport;
use App\Models\User;
use App\Repositories\Traits\GetUserAuthTrait;

class ReplyRepository
{
    use GetUserAuthTrait;
    public function __construct(
        protected ReplySupport $replySupport,
        protected SupportRepository $supportRepository
    ){}

    public function createReplyToSupportId(string $supportID, array $data)
    {
        $user = $this->getUserAuth();
        return $this->supportRepository->getSupport($supportID)
            ->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id
            ]);

    }
}
