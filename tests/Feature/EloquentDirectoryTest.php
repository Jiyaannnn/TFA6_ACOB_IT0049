<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EloquentDirectoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_records_and_all_four_pages_are_available(): void
    {
        $this->seed();
        $this->assertDatabaseCount('customers', 5);
        $this->assertDatabaseCount('users', 5);
        foreach (['/', '/about', '/customers', '/users'] as $route) {
            $this->get($route)->assertOk();
        }
        $this->get('/customers')->assertSee('customer1@example.com')->assertSee('0900-000-0001');
        $this->get('/users')->assertSee('jacob')->assertSee('Jian Acob');
        $this->get('/missing-page')->assertNotFound();
    }

    public function test_reseeding_updates_samples_without_duplicates(): void
    {
        $this->seed();
        Customer::first()->update(['full_name' => 'Changed locally']);
        $this->seed(DatabaseSeeder::class);
        $this->assertDatabaseCount('customers', 5);
        $this->assertDatabaseCount('users', 5);
        $this->assertDatabaseHas('customers', ['full_name' => 'Santos Family Residence']);
    }

    public function test_pages_reflect_database_changes_and_escape_html(): void
    {
        $customer = Customer::factory()->create(['full_name' => '<script>alert(1)</script>', 'phone' => null]);
        $user = User::factory()->create(['full_name' => 'Database Team Member']);
        $this->get('/customers')->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false)->assertSee('Phone not provided');
        $this->get('/users')->assertSee($user->full_name);
        $customer->update(['full_name' => 'Updated database customer']);
        $this->get('/customers')->assertSee('Updated database customer');
        $customer->delete();
        $user->delete();
        $this->get('/customers')->assertOk()->assertDontSee('Updated database customer');
        $this->get('/users')->assertOk()->assertDontSee('Database Team Member');
    }

    public function test_database_rejects_duplicate_usernames(): void
    {
        User::factory()->create(['username' => 'duplicate']);
        $this->expectException(QueryException::class);
        User::factory()->create(['username' => 'duplicate']);
    }

    public function test_database_rejects_missing_required_customer_name(): void
    {
        $this->expectException(QueryException::class);
        Customer::factory()->create(['full_name' => null]);
    }

    public function test_migrations_can_roll_back_and_rebuild(): void
    {
        $this->artisan('migrate:reset', ['--force' => true])->assertSuccessful();
        $this->assertFalse(Schema::hasTable('customers'));
        $this->assertFalse(Schema::hasTable('users'));
        $this->artisan('migrate', ['--force' => true])->assertSuccessful();
        $this->seed();
        $this->assertDatabaseCount('customers', 5);
        $this->assertDatabaseCount('users', 5);
    }
}
