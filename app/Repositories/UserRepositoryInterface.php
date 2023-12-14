<?php
namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find a user by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id);

     /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

     /**
     * Update a user by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data);

     /**
     * Delete a user by ID.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id);
}
