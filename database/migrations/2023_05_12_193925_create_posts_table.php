<?php

declare(strict_types=1);
/*
 * This source code is the proprietary and confidential information of
 * Nur Wachid. You may not disclose, copy, distribute,
 *  or use this code without the express written permission of
 * Nur Wachid.
 *
 * Copyright (c) 2023.
 *
 *
 */

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
        Schema::create(config('post.tables.posts', 'posts'), function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('slug')->index()->unique();
            $table->string('title');
            $table->string('subtitle')->nullable()->comment('subtitle of title post');
            $table->longText('description')->nullable()->comment('description of post');
            $table->string('type');
            $table->boolean('is_sticky')->default(false);

            $table->integer('published_at')->nullable();
            $table->string('language')->default('en');
            $table->string('layout')->nullable();

            $table->userstamps();
            $table->softUserstamps();

            $table->integer('deleted_at')->index()->nullable();
            $table->integer('created_at')->index()->nullable();
            $table->integer('updated_at')->index()->nullable();

            $table->index('id', 'posts_id_idx', 'hash');
            $table->index('slug', 'posts_slug_idx', 'hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('post.tables.posts', 'posts'));
    }
};
