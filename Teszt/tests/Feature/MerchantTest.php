<?php

namespace Tests\Feature;

use App\Models\Merchant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MerchantTest extends TestCase
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

        $response = $this->postJson('/api/merchants/create', [
            
            'name' => "Lajos",
            
            'address' => "Szar utca 1",
            
            'phone' => "3670-123-45/67",
            
            'active' => "0",
        ]);

        $response->assertStatus(201);
    }

    public function test_Delete()
    {
        $this->seed();

        $ped = new Merchant();
        
        $ped->name = "törlés";
        
        $ped->address = "törlés";
        
        $ped->phone = "törlés";
        
        $ped->active = "1";
        
        $ped->save();

        $response = $this->delete('/api/merchants/delete/' . $ped['id']);

        $response->assertStatus(204);
    }

    public function test_get()
    {
        $this->seed();

        $response = $this->get('/api/merchants/get');
        
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->seed();

        $ped = new Merchant();
        
        $ped->name = "törlés";
        
        $ped->address = "törlés";
        
        $ped->phone = "törlés";
        
        $ped->active = "0";
        
        $ped->save();

        $response = $this->putJson('/api/merchants/update/' . $ped['id'], [
        
            'name' => "asdasd",
        
            'address' => "asd utca 3",
        
            'phone' => "21341242",
        
            'active' => "0",
        
        ]);

        $response->assertStatus(200);
        $ped->delete();
    }
}