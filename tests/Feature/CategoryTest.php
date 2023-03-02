<?php

namespace Tests\Feature;

use App\Http\Controllers\CategoryController;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    private CategoryController $controller;

    public function test_success_findAll_data_categories()
    {
        $this->controller = new CategoryController();
        $data = $this->controller->index();

        $this->assertNotNull($data);
    }

    public function test_failed_findAll_data_categories()
    {
        $this->controller = new CategoryController();
        $data = $this->controller->index();

        $this->assertNull($data);
    }

    public function test_success_findById_data_category()
    {
        $this->controller = new CategoryController();
        $data = $this->controller->show(1);

        $this->assertNotNull($data);
    }

    public function test_failed_findById_data_category()
    {
        $this->controller = new CategoryController();
        $data = $this->controller->show(0);

        $this->assertNull($data);
    }

    public function test_success_store_data_category()
    {
        $this->controller = new CategoryController();
        $request = new CategoryStoreRequest();

        $request['name'] = fake()->words(2, true);
        $response = $this->controller->store($request);

        $this->assertTrue($response);
    }

    public function test_failed_store_data_category()
    {
        $this->controller = new CategoryController();
        $request = new CategoryStoreRequest();

        $this->expectException(ValidationException::class);
        $request['name'] = 2;
        $response = $this->controller->store($request);

        $this->assertFalse($response);
    }

    public function test_success_update_data_category()
    {
        $this->controller = new CategoryController();
        $request = new CategoryUpdateRequest();

        $request['name'] = fake()->words(2, true);
        $response = $this->controller->update($request, 3);

        $this->assertTrue($response);
    }

    public function test_failed_update_data_category()
    {
        $this->controller = new CategoryController();
        $request = new CategoryUpdateRequest();

        $this->expectException(ValidationException::class);
        $request['name'] = 2;
        $response = $this->controller->update($request, 3);

        $this->assertFalse($response);
    }

    public function test_success_delete_data_category()
    {
        $this->controller = new CategoryController();
        $response = $this->controller->destroy(2);

        $this->assertTrue($response);
    }

    public function test_failed_delete_data_category()
    {
        $this->controller = new CategoryController();
        $response = $this->controller->destroy(0);

        $this->assertFalse($response);
    }
}
