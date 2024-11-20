<?php

declare(strict_types=1);

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

        Schema::create('contents', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->ulidMorphs('model');
            $table->text('content_raw');
            $table->text('content_html');

            $table->userstamps();
            $table->softUserstamps();

            $table->integer('deleted_at')->index()->nullable();
            $table->integer('created_at')->index()->nullable();
            $table->integer('updated_at')->index()->nullable();

            $table->index('id', 'contents_id_idx', 'hash');
            $table->index('model_id', 'contents_model_id_idx', 'hash');
            $table->index('model_type', 'contents_model_type_idx', 'hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
