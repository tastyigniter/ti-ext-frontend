<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        if ($this->hasLanguageIdForeignKey()) {
            return;
        }

        rescue(function() {
            Schema::table('igniter_frontend_banners', function(Blueprint $table) {
                $table->foreignId('language_id')->nullable()->change();
                $table->foreign('language_id')
                    ->references('language_id')
                    ->on('languages')
                    ->nullOnDelete()
                    ->cascadeOnUpdate();
            });
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        try {
            Schema::table('igniter_frontend_banners', function(Blueprint $table) {
                $table->dropForeignKeyIfExists('language_id');
            });
        } catch (\Exception $e) {
        }
    }

    protected function hasLanguageIdForeignKey()
    {
        $foreignKeys = array_map(function($key) {
            return array_get($key, 'name');
        }, Schema::getForeignKeys('igniter_frontend_banners'));

        $prefix = Schema::getConnection()->getTablePrefix();

        return in_array($prefix.'_igniter_frontend_banners_language_id_foreign', $foreignKeys);
    }
};
