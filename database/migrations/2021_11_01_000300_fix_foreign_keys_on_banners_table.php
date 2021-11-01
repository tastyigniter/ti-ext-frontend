<?php

namespace Igniter\FrontEnd\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeysOnBannersTable extends Migration
{
    public function up()
    {
        Schema::table('igniter_frontend_banners', function (Blueprint $table) {
            $table->dropForeign(['language_id']);

            $table->foreignId('language_id')
                ->nullable()
                ->change()
                ->constrained('languages', 'language_id')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    public function down()
    {
    }
}
