<?php

namespace Tests\Feature;

use App\Models\RecordCategory;
use App\Services\RecordCategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PDO;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class RecordCategoryServiceTest extends TestCase
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

    public function test_show_all()
    {
        $service = new RecordCategoryService();
        $res = $service->findAll();
        $this->assertArrayHasKey("category_name", $res[0]);
    }

    public function test_insert_success()
    {
        $service = new RecordCategoryService();
        $res = $service->insert([
            "category_name" => $this->faker->name()
        ]);
        $this->assertTrue($res['status']);
    }

    public function test_insert_failed()
    {
        $service = new RecordCategoryService();
        $res = $service->insert([
            "category_name" => "kepala"
        ]);
        $this->assertFalse($res['status']);
    }

    public function test_update_success()
    {
        $service = new RecordCategoryService();
        $res = $service->update(
            2,
            [
                "category_name" => $this->faker->name()
            ]
        );
        $this->assertTrue($res['status']);
    }
    public function test_update_failed()
    {
        $service = new RecordCategoryService();
        $res = $service->update(
            100000,
            [
                "category_name" => $this->faker->name()
            ]
        );
        $this->assertFalse($res['status']);
    }

    public function test_find_by_id_sucess()
    {
        $service = new RecordCategoryService();
        $res = $service->findByid(1);
        $this->assertNotNull($res);
    }

    public function test_find_by_id_not_found()
    {
        $service = new RecordCategoryService();
        $res = $service->findByid(100000);
        $this->assertNull($res);
    }

    public function test_delete_success()
    {
        $service = new RecordCategoryService();
        $res = RecordCategory::create(
            ['category_name' => $this->faker->name()]
        );
        $resDelete = $service->deleteById($res->id);
        $this->assertTrue($resDelete);
        $this->assertEquals(true , $resDelete);
    }
}