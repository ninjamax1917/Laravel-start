<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Article;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poly_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
            ->constrained()
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->morphs('commentable');

            $table->string('text');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poly_comments');
    }
};
