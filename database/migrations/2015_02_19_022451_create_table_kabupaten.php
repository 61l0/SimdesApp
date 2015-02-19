<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableKabupaten extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabupaten', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('_id');
            $table->integer('prov_id');
            $table->string('kode_kab');
            $table->string('kab');
            $table->timestamps();
            $table->index(['_id']);
            $table->foreign('prov_id')->references('_id')->on('provinsi');
            # fulltext search kab, kode_kab
            # validation required [prov_id,kode_kab,kab]
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kabupaten');
    }

}
