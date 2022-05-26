<?php

namespace Igniter\FrontEnd\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (Schema::hasTable('igniter_frontend_banners'))
            return;

        if (Schema::hasTable('banners'))
            Schema::rename('banners', 'igniter_frontend_banners');
    }

    public function down()
    {
    }
};
