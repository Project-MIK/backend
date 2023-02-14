<?php

namespace Tests\Feature;

use App\Http\Requests\MedicinesStoreRequest;

use App\Http\Requests\StoreMedicinesRequest;
use App\Http\Requests\MedicinesUpdateRequest;
use App\Services\MedicineService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class MedicinesServiceTest extends TestCase
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


    public function test_get_all(){
        $service  = new MedicineService();
        $res = $service->findAll();
        $this->assertNotNull($res);
    }

    public function test_find_by_id_success(){
        $service  = new MedicineService();
        $res = $service->findById(1);
        $this->assertNotNull($res);
    }
    public function test_find_by_id_failed(){
        $service  = new MedicineService();
        $res = $service->findById(123123);
        $this->assertNull($res);
    }

    public function test_insert_success(){
        $service  = new MedicineService();
        $request = new MedicinesStoreRequest();
        $request['name'] = $this->faker->name();
        $request['stock'] = 20;
        $request['price'] = 200000;
        $res = $service->insert($request->validate($request->rules()));
        $this->assertTrue($res);
    }

    public function test_insert_failed(){
        $this->expectException(ValidationException::class);
        $service  = new MedicineService();
        $request = new MedicinesStoreRequest();
        $request['name'] = "influeza";
        $request['stock'] = 20;
        $request['price'] = 200000;
        $res = $service->insert($request->validate($request->rules()));
    }

    public function test_update_success(){
        $service  = new MedicineService();
        $request = new MedicinesUpdateRequest();
        $request['name'] = $this->faker->name();
        $request['stock'] = 20;
        $request['price'] = 200000;
        $res = $service->update(
            $request->validate($request->rules()) , 2
        );
        $this->assertTrue($res['status']);
    }

    public function test_update_failed_data_not_found(){
        $service  = new MedicineService();
        $request = new MedicinesUpdateRequest();
        $request['name'] = $this->faker->name();
        $request['stock'] = 20;
        $request['price'] = 200000;
        $res = $service->update(
            $request->validate($request->rules()) , 100
        );
        $this->assertFalse($res['status']);
    }
    public function test_update_failed_notchanges(){
        $service  = new MedicineService();
        $request = new MedicinesUpdateRequest();
        $request['name'] = "influeza";
        $request['stock'] = 20;
        $request['price'] = 200000;
        $res = $service->update(
            $request->validate($request->rules()) , 1
        );
        $this->assertFalse($res['status']);
    }

    public function test_destroy_success(){
        $service  = new MedicineService();
        $res = $service->destroy(3);
        $this->assertTrue($res);
    }
    
    
}
