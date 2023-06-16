<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts_tags', function (Blueprint $table) {
            $table->foreign(['post_id'], 'posts_tags_ibfk_1')->references(['id'])->on('posts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tag_id'], 'posts_tags_ibfk_2')->references(['id'])->on('tags')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_tags', function (Blueprint $table) {
            $table->dropForeign('posts_tags_ibfk_1');
            $table->dropForeign('posts_tags_ibfk_2');
        });
    }
};
