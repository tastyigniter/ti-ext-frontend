<?php

declare(strict_types=1);

namespace Igniter\Frontend\Models;

use Override;
use Igniter\Flame\Database\Attach\HasMedia;
use Igniter\Flame\Database\Attach\Media;
use Igniter\Flame\Database\Model;
use Igniter\Flame\Database\Traits\Validation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

/**
 * Slider Model
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Media> $images
 * @property-read Collection<int, Media> $media
 * @property-read int|null $media_count
 * @mixin Model
 */
class Slider extends Model
{
    use HasMedia;
    use Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'igniter_frontend_sliders';

    /**
     * @var array<string>|bool guarded fields
     */
    protected $guarded = [];

    public $timestamps = true;

    public $rules = [
        ['name', 'admin::lang.label_name', 'required|string'],
        ['code', 'igniter.frontend::default.slider.label_code', 'required|alpha_dash'],
    ];

    public $mediable = [
        'images' => ['multiple' => true],
    ];

    #[Override]
    public function getMorphClass()
    {
        return 'sliders';
    }
}
