<?php

use App\Enums\BaseStatusEnum;
use App\Models\Options;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_set_id');
            $table->string('value');
            $table->string('status')->default(BaseStatusEnum::PUBLISHED)->nullable();
            $table->timestamps();

            $table->foreign('option_set_id')->references('id')->on('option_sets')->cascadeOnDelete();

        });

        //create default Option Option
        Options::create(['option_set_id' => 1, 'value'=>'S']);
        Options::create(['option_set_id' => 1, 'value'=>'M']);
        Options::create(['option_set_id' => 1, 'value'=>'L']);
        Options::create(['option_set_id' => 1, 'value'=>'Xl']);

        Options::create(['option_set_id' => 2, 'value'=>'Red']);
        Options::create(['option_set_id' => 2, 'value'=>'Blue']);
        Options::create(['option_set_id' => 2, 'value'=>'Green']);

        $consoleOutput = new ConsoleOutput();
        $consoleOutput->writeln('some Colors and Size is added');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
