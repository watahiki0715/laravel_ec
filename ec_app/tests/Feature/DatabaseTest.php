<?php

namespace Tests\Feature;

use App\User;
use App\Admin;
use App\ec_item;
use App\ec_cart;
use App\ec_history;
use App\ec_detail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testExample()
    {
        factory(User::class)->create([
            'name' => 'aaa',
            'password' => 'ABCABC',
            'remember_token' => 'ABCABCABCABCA',
        ]);
        $this->assertDatabaseHas('users',[
            'name' => 'aaa',
            'password' => 'ABCABC',
            'remember_token' => 'ABCABCABCABCA',
        ]);
        factory(Admin::class)->create([
            'name' => 'aaa',
            'password' => 'ABCABC',
            'remember_token' => 'ABCABCABCABCA',
        ]);
        $this->assertDatabaseHas('admins',[
            'name' => 'aaa',
            'password' => 'ABCABC',
            'remember_token' => 'ABCABCABCABCA',
        ]);
        factory(ec_item::class)->create([
            'name' => 'aaa',
            'price' => 1000,
            'image' => 'ABCABCABCABCABCABCABCAB.png',
            'status' => 1,
            'stock' => 100,
            'detail' => 'ABCABCABCABCA',
            'categories' => '寿司',
        ]);
        $this->assertDatabaseHas('ec_items',[
            'name' => 'aaa',
            'price' => 1000,
            'image' => 'ABCABCABCABCABCABCABCAB.png',
            'status' => 1,
            'stock' => 100,
            'detail' => 'ABCABCABCABCA',
            'categories' => '寿司',
        ]);
        factory(ec_cart::class)->create([
            'user_id' => 10,
            'item_id' => 10,
            'amount' => 100,
        ]);
        $this->assertDatabaseHas('ec_carts',[
            'user_id' => 10,
            'item_id' => 10,
            'amount' => 100,
        ]);
        factory(ec_history::class)->create([
            'user_id' => 10,
            'total' => 10000,
        ]);
        $this->assertDatabaseHas('ec_histories',[
            'user_id' => 10,
            'total' => 10000,
        ]);
        factory(ec_detail::class)->create([
            'history_id' => 10,
            'item_id' => 10,
            'amount' => 100,
            'subtotal' => 1000,
        ]);
        $this->assertDatabaseHas('ec_details',[
            'history_id' => 10,
            'item_id' => 10,
            'amount' => 100,
            'subtotal' => 1000,
        ]);
    }
}
