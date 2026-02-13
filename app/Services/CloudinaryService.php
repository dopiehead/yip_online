<?php
namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService {

    private static $cloudinary;

    public static function init() {
        if (!self::$cloudinary) {

            $cloudName = $_ENV['CLOUDINARY_CLOUD_NAME'] ?? null;
            $apiKey    = $_ENV['CLOUDINARY_API_KEY'] ?? null;
            $apiSecret = $_ENV['CLOUDINARY_API_SECRET'] ?? null;

            if (!$cloudName || !$apiKey || !$apiSecret) {
                throw new \Exception("Cloudinary configuration missing. Check your .env file.");
            }

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

    // ✅ Upload and return BOTH url + public_id
    public static function upload($filePath, $folder = "ecommerce") {
        $cloud = self::init();

        try {
            $upload = $cloud->uploadApi()->upload($filePath, [
                "folder" => $folder
            ]);

            return [
                "url" => $upload['secure_url'],
                "public_id" => $upload['public_id']
            ];

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
