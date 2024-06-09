<?php

use App\Models\Article;
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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Article::class);
            $table->integer('value');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rating']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['rating', 'votes']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');

        Schema::table('users', function (Blueprint $table) {
            $table->float('rating')->default(0);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->float('rating')->default(0);
            $table->integer('votes')->default(0);
        });
    }
};
