<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements UserRepositoryInterface
{
    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Product::all();
    }

    /**
     * Find a product by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return Product::find($id);
    }

    /**
     * Create a new product.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return Product::create($data);
    }


    /**
     * Update a product by ID.
     *
     * @param  int  $id
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $data)
    {
        $user = Product::find($id);
        $user->update($data);

        return $user;
    }

     /**
     * Delete a product by ID.
     *
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        Product::destroy($id);
    }
}
