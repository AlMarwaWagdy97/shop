<?php

use App\Enums\BaseStatusEnum;
use App\Models\option_sets;
use App\Models\OptionSets;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_sets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(BaseStatusEnum::PUBLISHED)->nullable();
            $table->timestamps();
        });


        //create default Option Sets
        OptionSets::create(['name'=>'size']);
        OptionSets::create(['name'=>'color']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_sets');
    }
}
