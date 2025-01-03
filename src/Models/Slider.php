<?php

namespace Igniter\Frontend\Models;

use Igniter\Flame\Database\Attach\HasMedia;
use Igniter\Flame\Database\Model;
use Igniter\Flame\Database\Traits\Validation;

/**
 * Slider Model
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Igniter\Flame\Database\Attach\Media> $media
 * @property-read int|null $media_count
 * @mixin \Igniter\Flame\Database\Model
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
     * @var array fillable fields
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

    public function getMorphClass()
    {
        return 'sliders';
    }
}
