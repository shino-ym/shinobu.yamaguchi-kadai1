<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();

    // 外部キー
    $table->unsignedBigInteger('category_id');
    $table->foreign('category_id')
        ->references('id')
        ->on('categories')
        ->onDelete('restrict');

    $table->string('first_name');
    $table->string('last_name');
    $table->tinyInteger('gender'); // 男性=1, 女性=2, その他=3 なら tinyInteger が良い
    $table->string('email');
    $table->string('tel1');
    $table->string('tel2');
    $table->string('tel3');
    $table->string('tel'); // まとめた電話番号
    $table->string('address');
    $table->string('building')->nullable();
    $table->text('detail'); // お問い合わせ内容
    $table->timestamps();
});
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
