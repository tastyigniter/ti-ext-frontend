<?php

namespace Igniter\Frontend\Models;

use Igniter\Flame\Database\Model;
use Igniter\Main\Helpers\ImageHelper;
use Igniter\System\Models\Concerns\Switchable;

/**
 * Banners Model Class
 */
class Banner extends Model
{
    use Switchable;

    /**
     * @var string The database table name
     */
    protected $table = 'igniter_frontend_banners';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'banner_id';

    protected $fillable = ['name', 'type', 'click_url', 'language_id', 'alt_text', 'image_code', 'custom_code', 'status'];

    public $relation = [
        'belongsTo' => [
            'language' => \Igniter\System\Models\Language::class,
        ],
    ];

    protected $casts = [
        'image_code' => 'serialize',
        'language_id' => 'integer',
        'status' => 'boolean',
    ];

    //
    // Accessors & Mutators
    //

    public function getTypeLabelAttribute()
    {
        return ucwords($this->type);
    }

    //
    // Helpers
    //

    public function getLanguageIdOptions()
    {
        return $this->dropdown('name');
    }

    public function getImageThumb($options = [])
    {
        $defaults = ['name' => 'no_photo.png', 'path' => 'data/no_photo.png', 'url' => $options['no_photo']];

        if (empty($this->image_code)) {
            return $defaults;
        }

        $image = unserialize($this->image_code);

        if (empty($image['path'])) {
            return $defaults;
        }

        return $this->getThumbArray($image['path'], 120, 120);
    }

    public function getCarouselThumbs($options = [])
    {
        $images = [];

        if (empty($this->image_code)) {
            return $images;
        }

        $image = unserialize($this->image_code);

        if (!is_array($image['paths'])) {
            return $images;
        }

        foreach ($image['paths'] as $path) {
            $images[] = $this->getThumbArray($path, 120, 120);
        }

        return $images;
    }

    public function getThumbArray($file_path, $width = 120, $height = 120)
    {
        return [
            'name' => basename($file_path),
            'path' => $file_path,
            'url' => ImageHelper::resize($file_path, $width, $height),
        ];
    }
}
