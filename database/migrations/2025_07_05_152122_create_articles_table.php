<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->string("title");
            $table->string("slug")->unique();
            $table->longText("content"); // * Karena bisa pannjang bet
            $table->text("excerpt")->nullable(); // * Kutipan atau tldr;
            $table->string("featured_image_url")->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("draft");
            $table->unsignedBigInteger("views_count")->default(0);
            $table->timestamp("published_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
