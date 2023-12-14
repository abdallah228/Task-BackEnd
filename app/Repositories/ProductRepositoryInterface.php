<?php
namespace App\Repositories;

interface ProductRepositoryInterface
{
     /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();


    /**
     * Find a product by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id);

     /**
     * Create a new product.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

      /**
     * Update a product by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data);

    /**
     * Delete a product by ID.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id);
}
