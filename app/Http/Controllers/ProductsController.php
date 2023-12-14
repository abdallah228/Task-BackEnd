<?php

namespace App\Http\Controllers;

use App\Helpers\functions;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class ProductsController extends Controller
{
    protected $productRepository;

    /**
     * ProductsController constructor.
     *
     * @param  \App\Repositories\ProductRepositoryInterface  $productRepository
     */

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

     /**
     * Get all products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = $this->productRepository->all();

        return response()->json(['products' => $products]);
    }
     /**
     * Get a specific product by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
         // Adjust price based on user type using the helper function
         $userType = Auth::user()->type ?? null;
         $product = Functions::adjustPriceBasedOnUserType($product, $userType);

        return response()->json(['product' => $product]);
    }
    /**
     * Create a new product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|image',
                'price' => 'required|numeric',
                'slug' => 'required|string|unique:products',
                'is_active' => 'sometimes|boolean',
            ]);

            // Call the uploadImage function from the helper
            // Define data type: $data['image'] is a string (file path or URL)
            $data['image'] = Functions::uploadImage($request->file('image'));

            $product = $this->productRepository->create($data);

            return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

     /**
     * Update a product by ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $product = $this->productRepository->find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $data = $request->validate([
                'name' => 'sometimes|string',
                'description' => 'sometimes|string',
                'image' => 'sometimes|image',
                'price' => 'sometimes|numeric',
                'slug' => 'sometimes|string|unique:products,slug,' . $id,
                'is_active' => 'sometimes|boolean',
            ]);

            if ($request->hasFile('image')) {
                // Call the uploadImage function from the helper
                // Define data type: $data['image'] is a string (file path or URL)
                $data['image'] = Functions::uploadImage($request->file('image'));
            }

            $product = $this->productRepository->update($id, $data);

            return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a product by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $product = $this->productRepository->find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $this->productRepository->delete($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}

