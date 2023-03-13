<?php

namespace Tests\Feature;

use App\Services\RecipeDetailsService;
use App\Services\RecipesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeServiceTest extends TestCase
{
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
    public function test_insert(){
        $service = new RecipesService();
        $service->insert([]);
    }
    public function test_find(){
        $service = new RecipesService();
        $res = $service->checkFindByIdInRecord('KL0923210');
        dd($res);
    }

    public function test_store(){
        //{"id_recipe":18,"id_medicine":"1","qty":"2","total_price":40000}

        $data = [
            "id_recipe" => 18 , 
            "id_medicine" => 1,
            "qty" => 2,
            "total" => 40000
        ];
        $service = new RecipeDetailsService();
        $res = $service->insert($data);
        dd($res);
    }

    public function test_get_last_insert_id(){
        $service = new RecipesService();
        $id = $service->getLastInsertId();
    }


    public function test_check_medicine(){
        $service = new RecipeDetailsService();
        $res = $service->checkMedicine(2 , 1);
        $this->assertFalse($res);
    }
}
