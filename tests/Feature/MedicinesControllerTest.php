<?php

namespace Tests\Feature;

use App\Models\Medicines;
use Database\Factories\MedicinesFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;



class MedicinesControllerTest extends TestCase
{


    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_find_all()
    {
        $res = $this->get('/obat');
        $res->assertOk();
    }

    public function test_insert_success()
    {

        $data = [
            "name" => $this->faker->name(),
            "price" => 20,
            "stock" => 10,
        ];
        $res = $this->post('/obat', $data);
        $res->assertSessionHas("message", ['status' => true, 'message' => 'berhasil menambahkan obat']);
    }

    public function test_store_failed()
    {
        $data = [
            "name" => 'influeza',
            "price" => 20,
            "stock" => 10,
        ];
        $res = $this->post('/obat', $data);
        $res->assertSessionHasErrors();
    }


    public function test_find_by_id()
    {
        $res = $this->get('/obat/1');
        $res->assertOk();
    }


    public function test_update_success()
    {
        $data = [
            "name" => $this->faker->name(),
            "price" => 20,
            "stock" => 10,
        ];
        $res = $this->put("/obat/2", $data);
        $res->assertSessionHas('message', 'berhasil memperbarui data obat');
    }

    public function test_update_failed()
    {
        $data = [
            "name" => "influeza",
            "price" => 20,
            "stock" => 20000,
        ];
        $res = $this->put("/obat/1", $data);
        $res->assertSessionHasErrors('message', 'gagal memperbarui data obat , tidak ada perubahan');
    }


    public function test_update_failed_otherName()
    {
        $data = [
            "name" => "influeza",
            "price" => 20,
            "stock" => 20000,
        ];
        $res = $this->put("/obat/2", $data);
        $res->assertSessionHasErrors("message", "nama obat sudah digunakan");
    }

    public function test_delete()
    {
        $data =  Medicines::factory()->create();
        $response = $this->call('DELETE', "/obat/$data->id", ['_token' => csrf_token()]);
        $response->assertSessionHas('message');
    }
}
