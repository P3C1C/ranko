<?php

use App\Models\User;
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
        Schema::table('coordinators', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'owner_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinators', function (Blueprint $table) {    
            $table->dropForeign(['owner_id']);
            $table->dropColumn(['owner_id']);        
        });
    }
};
