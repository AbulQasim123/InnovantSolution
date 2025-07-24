<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function handleUploadedImage($file, $path, $delete = null)
    {
        if ($file) {
            // Delete old file if needed
            if ($delete && Storage::exists('public/' . $path . '/' . $delete)) {
                Storage::delete('public/' . $path . '/' . $delete);
            }

            $timestamp = Carbon::now()->timestamp;
            $random = rand(100000, 999999);
            $originalName = $file->getClientOriginalName();
            $sanitizedOriginal = preg_replace('/\s+/', '_', $originalName);
            $filename = "{$timestamp}_{$random}_{$sanitizedOriginal}";
            $file->storeAs('public/' . $path, $filename);

            return $filename;
        }
        return null;
    }

    public static function handleDeletedImage($data, $field, $delete_path)
    {
        if (!empty($data[$field])) {
            $filename = basename($data[$field]);
            $filePath = storage_path('app/public/' . $delete_path . $filename);
            if (file_exists($filePath)) {
                unlink($filePath);
                Log::info('File deleted successfully: ' . $filePath);
            } else {
                Log::warning('File not found for deletion: ' . $filePath);
            }
        }
    }
}
