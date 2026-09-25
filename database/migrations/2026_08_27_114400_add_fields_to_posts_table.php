<?php

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
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'body')) {
                $table->longText('body')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('body');
            }
            if (!Schema::hasColumn('posts', 'thumbnail')) {
                $table->string('thumbnail')->nullable()->after('excerpt');
            }
            if (!Schema::hasColumn('posts', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('status');
            }
            if (Schema::hasColumn('posts', 'content')) {
                $table->text('content')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['body', 'excerpt', 'thumbnail', 'is_published']);
        });
    }
};
