<?php

namespace App\Http\Controllers;

use App\Helpers\functions;
use App\Http\Requests\UsersRequestValidated;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    //
    protected $userRepository;

     /**
     * UserController constructor.
     *
     * @param  \App\Repositories\UserRepositoryInterface  $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository->all();

        return response()->json(['users' => $users]);
    }

    /**
     * Get a specific user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }

    /**
     * Create a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UsersRequestValidated $request): JsonResponse
    {
        try {
                $data = $request->validated();
                // Call the uploadImage function from the helper
                $data['avatar'] = Functions::uploadImage($request->file('avatar'));

                $user = $this->userRepository->create($data);

                return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
            } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update a user by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UsersRequestValidated $request, $id): JsonResponse
    {
        try {
            $user = $this->userRepository->find($id);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $data = $request->validated();
            if ($request->hasFile('avatar')) {
                // Call the uploadImage function from the helper
                $data['avatar'] = Functions::uploadImage($request->file('avatar'));
            }

            $user = $this->userRepository->update($id, $data);

            return response()->json(['message' => 'User updated successfully', 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $this->userRepository->delete($id);

        return response()->json(['message' => 'User deleted successfully']);
    }

}
