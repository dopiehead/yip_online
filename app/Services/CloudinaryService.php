<?php
namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService {

    private static $cloudinary;

    public static function init() {
        if (!self::$cloudinary) {

            // Read from env
            $cloudName = $_ENV['CLOUDINARY_CLOUD_NAME'] ?? null;
            $apiKey    = $_ENV['CLOUDINARY_API_KEY'] ?? null;
            $apiSecret = $_ENV['CLOUDINARY_API_SECRET'] ?? null;

            if (!$cloudName || !$apiKey || !$apiSecret) {
                throw new \Exception("Cloudinary configuration missing. Check your .env file.");
            }

            // Initialize Cloudinary with array config
            self::$cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => $cloudName,
                    'api_key'    => $apiKey,
                    'api_secret' => $apiSecret
                ],
                'url' => ['secure' => true]
            ]);
        }

        return self::$cloudinary;
    }

    public static function upload($filePath, $folder = "ecommerce") {
        $cloud = self::init();
        try {
            $upload = $cloud->uploadApi()->upload($filePath, [
                "folder" => $folder
            ]);
            return $upload['secure_url'];
        } catch (\Exception $e) {
            throw new \Exception("Cloudinary upload failed: " . $e->getMessage());
        }
    }

    
    public static function delete($publicId) {
        $cloud = self::init();
        try {
            return $cloud->uploadApi()->destroy($publicId);
        } catch (\Exception $e) {
            throw new \Exception("Cloudinary delete failed: " . $e->getMessage());
        }
    }
}
