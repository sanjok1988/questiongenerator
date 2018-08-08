<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Http\Controllers\StudentsController;

class SubjectTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testStore(){

        $data = ['name'=>'HCI', 'code'=>'cc201'];
        Input::replace($data);
        $request = Request::create('students/store','POST', $data);
        $controller = new StudentsController();
        $reponse = $controller->store($request);
        $this->assertResponseOk();
    }

}
