<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(<<<'SQL'
            CREATE TABLE groups (
                id BIGSERIAL,
                tenant_id BIGINT,
                name VARCHAR,
                PRIMARY KEY (id, tenant_id)
            ) PARTITION BY HASH (tenant_id);

            CREATE TABLE groups_1
            PARTITION OF groups
            FOR VALUES WITH (MODULUS 2, REMAINDER 0);

            CREATE TABLE groups_2
            PARTITION OF groups
            FOR VALUES WITH (MODULUS 2, REMAINDER 1);
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups_1');
        Schema::dropIfExists('groups_2');
        Schema::dropIfExists('groups');
    }
};
