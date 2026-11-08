<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Banner image codes were stored as PHP serialized arrays and read with unserialize().
 * Convert them to JSON so they are read with json_decode() and can never instantiate PHP objects.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('igniter_frontend_banners')->orderBy('banner_id')->chunkById(500, function($banners): void {
            foreach ($banners as $banner) {
                $imageCode = $this->legacyToJson($banner->image_code);
                if ($imageCode !== $banner->image_code) {
                    DB::table('igniter_frontend_banners')
                        ->where('banner_id', $banner->banner_id)
                        ->update(['image_code' => $imageCode]);
                }
            }
        }, 'banner_id');
    }

    protected function legacyToJson(?string $value): ?string
    {
        // Empty values and values already stored as JSON are left as they are.
        if (in_array($value, [null, ''], true) || json_validate($value)) {
            return $value;
        }

        // Values that cannot be unserialized, or that contain objects, are dropped.
        $decoded = @unserialize($value, ['allowed_classes' => false]);
        if (($decoded === false && $value !== 'b:0;') || is_object($decoded) || (is_array($decoded) && $this->containsObject($decoded))) {
            return null;
        }

        return json_encode($decoded, JSON_THROW_ON_ERROR);
    }

    protected function containsObject(array $value): bool
    {
        return array_any($value, fn($item): bool => is_object($item) || (is_array($item) && $this->containsObject($item)));
    }
};
