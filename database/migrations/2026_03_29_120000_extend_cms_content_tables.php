<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('featured_image')->nullable();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
        });

        Schema::table('article_category', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->unique(['article_id', 'category_id']);
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->unique(['article_id', 'tag_id']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
        });

        Schema::create('gallery_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->string('photo_group')->nullable()->comment('e.g. donations, member — for frontend tabs');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('show_in_nav')->default(false);
            $table->string('nav_group')->nullable();
            $table->string('nav_label')->nullable();
            $table->unsignedInteger('nav_sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_photos');

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['show_in_nav', 'nav_group', 'nav_label', 'nav_sort_order']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn([
                'title', 'slug', 'description', 'cover_image', 'sort_order', 'is_published',
            ]);
        });

        Schema::table('article_tag', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['tag_id']);
            $table->dropColumn(['article_id', 'tag_id']);
        });

        Schema::table('article_category', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['category_id']);
            $table->dropColumn(['article_id', 'category_id']);
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn([
                'author_id', 'title', 'slug', 'excerpt', 'body', 'featured_image',
                'status', 'published_at', 'is_featured', 'meta_title', 'meta_description', 'sort_order',
            ]);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn(['name', 'slug', 'description']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn([
                'name', 'slug', 'description', 'parent_id', 'sort_order', 'is_active', 'featured_image',
            ]);
        });
    }
};
