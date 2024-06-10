<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Page::class, 'category_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('locale')->default('en');
            $table->string('template')->nullable();
            $table->json('template_data')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
