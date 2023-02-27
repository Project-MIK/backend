<?php

namespace Tests\Feature;

use App\Models\RecordCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecordCategoryControllertest extends TestCase
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

    public function test_store_success()
    {
        $data = [
            "category_name" => $this->faker()->randomLetter . "" . $this->faker()->randomLetter . "" . $this->faker()->randomLetter . "" . $this->faker()->randomLetter
        ];
        $res = $this->post("/category", $data);
        $res->assertSessionHas("message", "berhasil menambahkan data category");
    }


    public function test_update_failed()
    {

        $data = [
            "category_name" => "perut"
        ];
        $res = $this->put("/category/1", $data);
        $res->assertSessionHasErrors();
    }

    public function test_update_success()
    {

        $data = [
            "category_name" => $this->faker()->randomLetter . "" . $this->faker()->randomLetter . "" . $this->faker()->randomLetter . "" . $this->faker()->randomLetter
        ];
        $res = $this->put("/category/2", $data);
        $res->assertSessionHas("message", "berhasil memperbarui data category");
    }


    public function test_find_success()
    {
        $res = $this->get("/category/1");
        $this->assertNotEmpty($res->getOriginalContent()->category_name);
    }

    public function test_delete_success(){
        $data = RecordCategory::create(
            [
                "category_name" => $this->faker->name()
            ]
        );
        $res = $this->delete("/category/$data->id");
        $res->assertSessionHas("message" , "berhasil menghapus category");
    }


}