<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
class LoginTest extends DuskTestCase
{

  /**
   * A Dusk test example.
   *
   * @test
   */
   public function login_user()
    {
     $this->browse(function ($browser) {
       $browser->visit('/admin')
                  ->type('email','shubham@gmail.com')
                  ->type('password', 'Admin123')
                  ->press('Sign In')
                  ->assertPathIs('/admin-dash');

      });
    }
    /**
     * A Dusk test example.
     *
     * @test
     */

     public function mouse(){
       $this->browse(function ($browser){
         $browser->visit('/admin/coupons/create')
                    ->type('title','Newcoupom')
                    ->type('code','NEW20')
                    ->select('type','Amount')
                    ->type('discount','5')
                    ->press('Create')
                   ->assertPathIs('/admin/coupons/create');



       });
     }

}
