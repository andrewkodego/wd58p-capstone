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
        Schema::create('module_rights', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->integer('module_id');
            $table->integer('can_view_all')->nullable()->default(0);
            $table->integer('can_view_own')->nullable()->default(0);
            $table->integer('can_add')->nullable()->default(0);
            $table->integer('can_edit_all')->nullable()->default(0);
            $table->integer('can_edit_own')->nullable()->default(0);
            $table->integer('can_delete_all')->nullable()->default(0);
            $table->integer('can_delete_own')->nullable()->default(0);
            $table->integer('can_export')->nullable()->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('modified_by')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_rights');
    }
};
