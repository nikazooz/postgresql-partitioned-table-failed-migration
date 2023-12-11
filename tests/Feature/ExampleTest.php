<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_group_name_can_be_inserted(): void
    {
        DB::table('groups')->insert([
            'tenant_id' => 1,
            'name' => $name = fake()->word(),
        ]);

        $this->assertTrue(DB::table('groups')->where('name', $name)->exists());
    }
}
