<?php

namespace App\Services;

use App\Models\User;
use App\Models\Whiteboard;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WhiteboardService
{
    public function __construct() {}

    public function list(User $user): Collection
    {
        return $user->whiteboards;
    }

    public function create(array $data, User $user): Whiteboard
    {
        $data = array_merge($data, [
            'identifier' => Str::uuid(),
            'user_id' => $user->id,
        ]);

        return Whiteboard::create($data);
    }

    public function update(array $data, Whiteboard $whiteboard): Whiteboard
    {
        $whiteboard->fill($data)->save();

        return $whiteboard;
    }

    public function delete(Whiteboard $whiteboard): void
    {
        $whiteboard->delete();
    }
}
