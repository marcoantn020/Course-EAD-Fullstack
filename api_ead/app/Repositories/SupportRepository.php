<?php

namespace App\Repositories;


use App\Models\Support;
use App\Models\User;
use App\Repositories\Traits\GetUserAuthTrait;
use Illuminate\Database\Eloquent\Model;

class SupportRepository
{
    use GetUserAuthTrait;
    public function __construct(
        protected Support $support
    ){}

    public function getMySupport(array $filters = [])
    {
        $filters['user'] = true;
        return $this->getSupports($filters);
    }

    public function getSupports(array $filters = [])
    {
        return $this->support
            ->where(function ($query) use ($filters) {
                if(isset($filters['lesson'])) {
                    $query->where('lesson_id', '=', $filters['lesson']);
                }

                if(isset($filters['status'])) {
                    $query->where('status', '=', $filters['status']);
                }

                if(isset($filters['description'])) {
                    $query->where('description', 'LIKE', "%{$filters['description']}%");
                }

                if(isset($filters['user'])) {
                    $user = $this->getUserAuth();
                    $query->where('user_id', '=', $user->id);
                }
            })
            ->with('replies')
            ->orderBy('updated_at')
            ->paginate(2);
    }

    public function createNewSupport(array $data): Model
    {
        $data['status'] = 'pending';
        return $this->getUserAuth()
            ->supports()
            ->create($data);
    }

    public function createReplyToSupportId(string $supportId, array $data)
    {
        $user = $this->getUserAuth();

        return $this->getSupport($supportId)
                    ->replies()
                    ->create([
                        'description' => $data['description'],
                        'user_id' => $user->id,
                    ]);
    }

    public function getSupport(string $supportID)
    {
        return $this->support->findOrFail($supportID);
    }
}
