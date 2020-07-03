<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class History_detailControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        //ユーザーログイン前
        $response = $this->get('/history_detail');
        $response->assertStatus(302);
        
        //ユーザーログイン後
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/history_detail');
        $response->assertStatus(200);

        //ページのないアドレス
        $response = $this->get('/no_route');
        $response->assertStatus(404);

    }
}
