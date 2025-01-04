<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    public function __construct() {}

    public function listUsers(bool $withTrashed = false): Collection
    {
        return User::orderBy('name')->get();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, User $user): User
    {
        $user->fill($data)->save();

        return $user;
    }

    public function delete(User $user): void
    {
        abort_if(
            $user->id == auth()->id(),
            Response::HTTP_CONFLICT,
            __('Não é possível excluir o usuário autenticado.')
        );

        $user->delete();
    }
}
