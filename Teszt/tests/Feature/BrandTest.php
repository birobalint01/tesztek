<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\BrandController;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;

class BrandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

     public function test_Create()
    {
        $this->seed();

        $response = $this->postJson('/api/brands/create', [
            'name' => "Bugatti"
        ]);

        $response->assertStatus(201);
    }

    public function test_Delete()
    {
        $this->seed();

        $brand = new Brand();
        
        $brand->name = "Teszt törlése";
        
        $brand->save();

        $response = $this->delete('/api/brands/delete/' . $brand['id']);

        $response->assertStatus(204);
    }

    public function test_get()
    {
        $this->seed();

        $response = $this->get('/api/brands/get');
        
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();

        $brand = new Brand();
        
        $brand->name = "Teszt frissítése";
        
        $brand->save();


        $response = $this->putJson('/api/brands/update/' . $brand['id'], [
            
            "brand_id" => $brand['id'],
            
            "name" => "Az update sikeresen lefutott!",
        ]);

        $response->assertStatus(200);
        
        $brand->delete();
    }
}