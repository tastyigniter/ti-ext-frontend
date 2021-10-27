<?php

namespace Igniter\FrontEnd\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBannersTable extends Migration
{
    public function up()
    {
        Schema::rename('banners', 'igniter_frontend_banners');

        Schema::table('igniter_frontend_banners', function (Blueprint $table) {
            $table->unsignedBigInteger('banner_id')->change();
            $table->foreignId('language_id')->change()->constrained('languages', 'language_id');
        });
    }

    public function down()
    {
        Schema::table('igniter_frontend_banners', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
        });
    }
}
