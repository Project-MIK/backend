<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Http\Requests\KeyRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session as FacadesSession;
use PDOException;
use Tests\TestCase;

class AdminTest extends TestCase
{


    private AdminController $admin;

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

    public function test_get_return_index_as_array()
    {
        $this->admin = new AdminController();
        $response = $this->admin->index();
        $this->assertNotNull($response);
    }

    public  function test_update_data()
    {
        $this->admin = new AdminController();
        $request = new UpdateAdminRequest();
        $request['name'] = "admin";
        $request['password'] = "rahasia";
        $request['email'] = "admin@gmail.com";
        $request['address'] = "kalbar";
        $adminData = new Admin();
        $adminData['id'] = 7;
        $response = $this->admin->update($request, $adminData);
        $this->assertNotNull($response);
    }

    public function test_insert_data_error_email_format()
    {
        // harus melewati routing untuk test format
        // $this->admin = new AdminController();
        // $request = new StoreAdminRequest();
        // $request['name'] = "zam";
        // $request['email'] = "erorr format";
        // $request['password'] = "rahasia";
        // $request['address'] = "bwi";
        // $data = $this->admin->store($request);
    }
    public function test_insert_error_duplicate_email()
    {
        $this->expectException(PDOException::class);
        $this->expectException(QueryException::class);
        $request = new StoreAdminRequest();
        $request['name'] = "zam";
        $request['email'] = "erorr format";
        $request['password'] = "rahasia";
        $request['address'] = "bwi";
        $this->admin = new AdminController();
        $this->admin->store($request);
    }
    public function test_delete_data_success()
    {
        $this->admin = new AdminController();
        $dataAdmin = new Admin();
        $dataAdmin['id'] = 22;
        $response = $this->admin->destroy($dataAdmin);
        $this->assertEquals(true, $response);
    }

    public function test_delete_data_not_found()
    {
        $this->admin = new AdminController();
        $dataAdmin = new Admin();
        $dataAdmin['id'] = 10000;
        $response = $this->admin->destroy($dataAdmin);
        $this->assertEquals(false, $response);
    }

    public function test_store_data()
    {
        $this->admin = new AdminController();
        $request = new StoreAdminRequest();
        $request['name'] = "zam";
        $request['email'] = "zamz@gmail.com";
        $request['password'] = "rahasia";
        $request['address'] = "bwi";
        $data = $this->admin->store($request);
        $this->assertNotNull($data);
    }


    public function test_find_by_name_success()
    {
        $store = new KeyRequest();
        $store['name'] = "admin";
        $this->admin = new AdminController();
        $data = $this->admin->findByname($store);
        $this->assertNotEmpty($data);
    }


    public function test_find_by_name_not_found()
    {
        $store = new KeyRequest();
        $store['name'] = "not found";
        $this->admin = new AdminController();
        $data = $this->admin->findByname($store);
        $this->assertEmpty($data);
    }

    public function test_find_by_email_success()
    {
        $store = new KeyRequest();
        $store['email'] = "admin@gmail.com";
        $this->admin = new AdminController();
        $data = $this->admin->findByEmail($store);
        $this->assertNotEmpty($data);
    }

    public function test_find_by_email_not_found()
    {
        $store = new KeyRequest();
        $store['email'] = "admin@notfound.com";
        $this->admin = new AdminController();
        $data = $this->admin->findByEmail($store);
        $this->assertEmpty($data);
    }

    public function test_get_all_data_in_service()
    {
        $service = new AdminService();
        $data = $service->findAll();
        $this->assertNotNull($data);
    }

    public function test_store_data_in_service()
    {
        $service = new AdminService();
        $request = new StoreAdminRequest();
        $request['name'] = "zam";
        $request['email'] = "email@emails.com";
        $request['password'] = bcrypt("rahasia");
        $request['address'] = "alamat";
        $response = $service->store($request->validate($request->rules()));
        $this->assertTrue($response);
    }

    public function test_update_data_in_service_success()
    {
        $service = new AdminService();
        $request = new UpdateAdminRequest();
        $request['name'] = "zam";
        $request['email'] = "email@emails.com";
        $request['password'] = bcrypt("rahasia");
        $request['address'] = "alamat";
        $admin = new Admin();
        $admin->id = 26;
        $response = $service->update($request->validate($request->rules()), $admin);
        $this->assertTrue($response);
    }

    public function test_update_data_in_service_failed()
    {
        $service = new AdminService();
        $request = new UpdateAdminRequest();
        $request['name'] = "zam";
        $request['email'] = "email@emails.com";
        $request['password'] = bcrypt("rahasia");
        $request['address'] = "alamat";
        $admin = new Admin();
        $admin->id = 10000;
        $response = $service->update($request->validate($request->rules()), $admin);
        $this->assertFalse($response);
    }

    public function test_find_by_email_in_service()
    {
        $keyword = "email@emails.com";
        $service = new AdminService();
        $data = $service->findByEmail($keyword);
        $this->assertNotNull($data);
    }

    public function test_find_by_email_in_service_failed()
    {
        $keyword = "email@emailsasdasdasd.com";
        $service = new AdminService();
        $data = $service->findByEmail($keyword);
        $this->assertNull($data);
    }

    public function test_find_update_not_change(){
        $service = new AdminService();
        $admin = new Admin();
        $admin->id = 1;
        $request =  new UpdateAdminRequest();
        $request['name'] = "admin";
        $request['email'] = "email@email.com";
        $request['address'] = "alamat";
        $newData = $request->validate($request->rules()['update']);
    }

    public function test_find_by_name_in_service()
    {
        $keyword = "zam";
        $service = new AdminService();
        $data = $service->findByName($keyword);
        dd($data);
        $this->assertNotNull($data);
    }
    public function test_find_by_name_in_service_failed()
    {
        $keyword = "jan";
        $service = new AdminService();
        $data = $service->findByName($keyword);
        $this->assertEquals(0 , $data->count());
    }

    public function test_find_by_id_in_service()
    {
        $id = 7;
        $service = new AdminService();
        $data = $service->findById($id);
        $this->assertNotNull($data);
    }

    public function test_find_by_id_in_service_failed()
    {
        $id = 101000;
        $service = new AdminService();
        $data = $service->findById($id);
        $this->assertNull($data);
    }

    public function test_delete_by_id_in_service_success(){
        $id = 26;
        $service = new AdminService();
        $response = $service->deleteById($id);
        $this->assertTrue($response);
    }
    public function test_delete_by_id_in_service_failed(){
        $id = 100000;
        $service = new AdminService();
        $response = $service->deleteById($id);
        $this->assertFalse($response);
    }
    public function test_find_by_name_post_in_controller(){
        $data = ["name" => "okeee"];
        $res = $this->post("/admin/findByName", $data);
        $this->assertNull($res);
    }

    
    public function test_store_controller(){
        $data=[
            "name" => "zam" , 
            "password" => "rahasia" , 
            "address" => "bwi" , 
            "email" => "zam@zam.com"
        ];
        $res = $this->post('/admin' , $data);
        dd($res);
    }

}
