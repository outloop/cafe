<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCafesTableAddParentChildRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('cafes', function( Blueprint $table ){
            $table->integer('parent')->unsigned()->nullable()->after('id');
            $table->string('location_name')->after('name')->default('');
            $table->integer('roaster')->after('longitude')->default(0);
            $table->text('website')->after('roaster')->nullable();
            $table->text('description')->after('website')->nullable();
            $table->integer('added_by')->after('description')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('cafes', function( Blueprint $table ){
            $table->dropColumn('parent');
            $table->dropColumn('location_name');
            $table->dropColumn('roaster');
            $table->dropColumn('website');
            $table->dropColumn('description');
            $table->dropColumn('added_by');
        });
    }
}
