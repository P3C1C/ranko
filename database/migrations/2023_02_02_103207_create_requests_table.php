<?php

use App\Models\Coordinator;
use App\Models\Group;
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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->enum('conferma', ['true', 'false'])->default('false');
            $table->foreignIdFor(Coordinator::class, 'coordinator_id')->nullable()->constrained('coordinators')->onDelete('cascade');
            $table->foreignIdFor(Group::class, 'group_id')->nullable()->constrained('groups')->onDelete('cascade');
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
        Schema::dropIfExists('requests');
    }
};
