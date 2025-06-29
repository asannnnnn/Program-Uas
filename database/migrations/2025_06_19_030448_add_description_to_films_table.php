<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToFilmsTable extends Migration
{
    public function up()
    {
       Schema::table('films', function (Blueprint $table) {
    $table->text('description')->nullable()->after('trailer_url');
});

    }

    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
