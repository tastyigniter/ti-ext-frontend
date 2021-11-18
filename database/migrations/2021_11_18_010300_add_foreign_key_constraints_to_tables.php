<?php

namespace Igniter\Frontend\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyConstraintsToTables extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        if ($this->hasLanguageIdForeignKey())
            return;

        Schema::table('igniter_frontend_banners', function (Blueprint $table) {
            $table->foreignId('language_id')->nullable()->change();
            $table->foreign('language_id')
                ->references('language_id')
                ->on('languages')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::table('igniter_frontend_banners', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
        });
    }

    protected function hasLanguageIdForeignKey()
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        $foreignKeys = array_map(function ($key) {
            return $key->getName();
        }, $conn->listTableForeignKeys('igniter_frontend_banners'));

        $prefix = Schema::getConnection()->getTablePrefix();

        return in_array($prefix.'_igniter_frontend_banners_language_id_foreign', $foreignKeys);
    }
}
