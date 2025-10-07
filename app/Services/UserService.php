<?php

namespace App\Services;

use App\Exceptions\CredentialsException;
use App\Exceptions\UserException;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Mail\AccountCreateMail;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Core\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class UserService implements UserInterface
{
    public function __construct(
        private UserRepository $repository
    ) {}

    public function getAll(): UserCollection
    {
        return new UserCollection($this->repository->getAll());
    }

    public function paginate(int $totalPage): LengthAwarePaginator
    {
        return $this->repository->paginate($totalPage);
    }

    public function findWhereFirst(string $column, string $value)
    {
        return $this->repository->findWhereFirst($column, $value);
    }

    public function applyFilter(array $data)
    {
        return $this->repository->applyFilter($data);
    }

    public function findById(int $id): UserResource
    {
        return new UserResource($this->repository->findById($id));
    }

    public function storeUser(array $data): void
    {
        $data['password'] = Str::random(10);

        $this->repository->store($data);

        Mail::to($data['email'])->send(new AccountCreateMail($data));
    }

    public function store(array $data)
    {
        $data['password'] = Str::random(10);

        $storeUser = $this->repository->storeUser($data);

        // Mail::to($data['email'])->send(new AccountCreateMail($data));

        return $storeUser;
    }

    public function update(array $request, int $id): void
    {
        $user = $this->findById($id);
        $this->repository->update($user, $request);
    }

    public function login(object $request)
    {
        $user = $this->repository->findWhereFirst('cpf', $request->cpf);

        if (!$user) {
            throw new CredentialsException($user);
        }

        if ($user->deleted_at != null) {
            throw new UserException('Usuário desativado! Favor entrar em contato com a Administração.');
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new CredentialsException($user);
        }

        $user->tokens()->delete();

        $user->update(['profile_id' => $request['profile_id']]);

        $user = $this->repository->findWhereFirst('cpf', $request->cpf);

        $abilities = $user->profile->abilities->pluck('slug')->toArray();

        return $user->createToken('AccessToken', $abilities, now()->addMinutes(480))->plainTextToken;
    }

    public function loggedInUser($request)
    {
        $abilities = $this->abilitesToArray($request->user());

        return new UserResource($abilities);
    }

    public function logout($request): void
    {
        $personalAccessToken = new PersonalAccessToken;
        $token = substr($request->headers->get('authorization'), 7);
        $personalAccessToken->findToken($token)->delete();
    }

    public function updatePassword(string $email, string $password): void
    {
        $this->repository->updatePassword(mb_strtolower($email), $password);
    }

    public function abilitesToArray($data)
    {
        $data['abilities'] = $this->repository->getUserAbilities($data->profile_id);

        return $data;
    }

    public function storeProfiles(array $request, int $id): void
    {
        $user = $this->findById($id);
        $this->repository->storeProfiles($user, $request);
    }

    public function destroy(int $id): void
    {
        $user = $this->findById($id);
        $this->repository->destroy($user);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}
