<?php

use App\Models\Request;
use App\Models\Student;
use App\Models\Teacher;
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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('voto');
            $table->string('note');
            $table->foreignIdFor(Student::class, 'student_id')->nullable()->constrained('students');
            $table->foreignIdFor(Teacher::class, 'teacher_id')->nullable()->constrained('teachers');
            $table->foreignIdFor(Request::class, 'request_id')->nullable()->constrained('requests');
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
        Schema::dropIfExists('ranks');
    }
};
