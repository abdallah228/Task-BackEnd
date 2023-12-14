<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class functions
{
    /**
     * Upload an image file to the specified destination path.
     *
     * @param \Illuminate\Http\UploadedFile $file The image file to upload.
     * @param string $destinationPath The destination path to store the image file.
     * @return string The file path where the image is stored.
     */
    public static function uploadImage(UploadedFile $file, $destinationPath = 'images')
    {
        // Generate a unique filename
        $filename = time() . '_' . $file->getClientOriginalName();
        // Store the image (avatar) file in the specified destination path
        $filePath = $file->storeAs($destinationPath, $filename, 'public');
        return $filePath;
    }



    /**
     * Adjust the price of a product based on the user's type.
     *
     * @param \stdClass $product The product to adjust the price for.
     * @param string|null $userType The type of the user ('gold', 'silver').
     * @return \stdClass The product with the adjusted price.
     */
    public static function adjustPriceBasedOnUserType($product, $userType)
    {
        // Customize the logic based on your requirements
        if ($userType === 'gold') {
            $product->price *= 0.9; // 10% discount for gold users
        } elseif ($userType === 'silver') {
            $product->price *= 0.95; // 5% discount for silver users
        }

        return $product;
    }
}
