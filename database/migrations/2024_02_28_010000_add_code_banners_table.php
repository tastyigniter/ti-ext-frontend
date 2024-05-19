<?php

namespace Igniter\Frontend\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('igniter_frontend_banners', function(Blueprint $table) {
            $table->string('code')->nullable()->after('name');
        });
    }
};
