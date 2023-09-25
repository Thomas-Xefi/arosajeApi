<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use function auth;

class UsersController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->all(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(): JsonResponse
    {
        return response()->json(
            auth()->user()
                ->load(['roles.permissions', 'notifications'])
                ->loadCount([
                    'notifications' => function (Builder $builder) {
                        $builder->whereNull('read_at');
                    }
                ])
        );
    }

    public function countNotifications() {
        $count = auth()->user()
            ->loadCount([
                'notifications' => function (Builder $builder) {
                    $builder->whereNull('read_at');
                }
            ])->notifications_count;

        return response()->json(
            $count
        );
    }

    public function notifications()
    {
        return response()->json(
            auth()->user()->load('notifications')->notifications
        );
    }

    public function readNotification(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return response()->json([
                'message' => 'Message lu avec succès'
            ]
        );
    }

    public function search(): JsonResponse
    {
        return response()->json(
            User::all()->load($this->includes)
        );
    }

    public function index(): JsonResponse
    {
        return response()->json(
            User::all()->load($this->includes)
        );
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(
            $user->load($this->includes)
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = new User();

        $user->fill($request->validated());
        $user->save();

        return response()->json([
            'message' => 'Account created successfully'
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return response()->json(
            $user
        );
    }
}
