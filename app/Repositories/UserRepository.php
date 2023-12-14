<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

     /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Find a user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return User::find($id);
    }

     /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return User::create($data);
    }

     /**
     * Update a user by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data)
    {
        $user = User::find($id);
        $user->update($data);

        return $user;
    }

     /**
     * Delete a user by ID.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        User::destroy($id);
    }
}
