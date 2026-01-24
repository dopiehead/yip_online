<?php
namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class CloudinaryService {

    private static $cloudinary;

    // Initialize Cloudinary
    public static function init() {
        if (!self::$cloudinary) {
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                    'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                    'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
                ],
                'url' => [
                    'secure' => true
                ]
            ]);

            self::$cloudinary = new Cloudinary();
        }

        return self::$cloudinary;
    }

    // Upload image
    public static function upload($filePath, $folder = "ecommerce") {
        self::init();
        try {
            $upload = self::$cloudinary->uploadApi()->upload($filePath, [
                "folder" => $folder
            ]);
            return $upload['secure_url'];
        } catch (\Exception $e) {
            throw new \Exception("Cloudinary upload failed: " . $e->getMessage());
        }
    }

    // Delete image
    public static function delete($publicId) {
        self::init();
        try {
            return self::$cloudinary->uploadApi()->destroy($publicId);
        } catch (\Exception $e) {
            throw new \Exception("Cloudinary delete failed: " . $e->getMessage());
        }
    }
}
