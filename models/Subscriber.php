<?php

namespace SamPoyigi\Featured_menus\Models;

use Model;

class Subscriber extends Model
{
    protected $table = 'sampoyigi_frontend_subscribers';

    protected $primaryKey = 'id';

    protected $fillable = ['email'];
}