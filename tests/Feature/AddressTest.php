<?php

namespace Tests\Feature;

use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the address find endpoint
     *
     * @return void
     */
    public function test_address_index_end_point(): void
    {
        $address = Address::factory()->create();

        $response = $this->get(config('app.url') . '/api/v1/lookup/' . $address->postcode);

        $response->assertStatus(200);
    }

    /**
     * Test the address show endpoint.
     */
    public function test_address_show_end_point(): void
    {
        $response = $this->get(config('app.url') . '/api/v1/lookup/show/NWRhZWE4NzVjNGYwNmNmIDEzOTY4Mzc0IGNiM2QzYjJjYTExZWNkZQ==');

        $response->assertStatus(200);
    }

    /**
     * Test the address find endpoint.
     */
    public function test_address_find_end_point(): void
    {
        $address = Address::factory()->create();

        $response = $this->get(config('app.url') . '/api/v1/lookup/find/' . $address->id);

        $response->assertStatus(200);
    }

    /**
     * Test the address store endpoint.
     */
    public function test_address_store_end_point(): void
    {
        // Store Record In Database
        $response = $this->post(config('app.url') . '/api/v1/address/store/NWRhZWE4NzVjNGYwNmNmIDEzOTY4Mzc0IGNiM2QzYjJjYTExZWNkZQ==');

        $response->assertStatus(200);

        // Try and store it again
        $response = $this->post(config('app.url') . '/api/v1/address/store/NWRhZWE4NzVjNGYwNmNmIDEzOTY4Mzc0IGNiM2QzYjJjYTExZWNkZQ==');

        $response->assertStatus(422);
    }

}
