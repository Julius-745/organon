<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_access');
        Schema::dropIfExists('logs');

        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'member']);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->id('org_id');
            $table->string('org_name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->foreignId('org_id')->constrained('organizations', 'org_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('position', 50)->nullable();
            $table->date('joined_at');
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->foreignId('org_id')->constrained('organizations', 'org_id')->onDelete('cascade');
            $table->string('title', 255);
            $table->enum('category', ['keuangan', 'notulen', 'surat', 'proposal', 'lainnya']);
            $table->string('file_path', 255);
            $table->foreignId('uploaded_by')->constrained('users', 'user_id')->onDelete('cascade');
            $table->timestamp('uploaded_at')->useCurrent();
        });

        Schema::create('document_access', function (Blueprint $table) {
            $table->id('access_id');
            $table->foreignId('doc_id')->constrained('documents', 'doc_id')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins', 'admin_id')->onDelete('cascade');
            $table->enum('permission', ['view', 'edit', 'delete']);
            $table->timestamp('granted_at')->useCurrent();
        });

        Schema::create('logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('action');
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
        Schema::dropIfExists('document_access');
        Schema::dropIfExists('documents');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('users');
    }
};