<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Categorías')
                    ->screenshot('inicio');
        });
    }

    /**
     *
     * @return void
     */

    public function testClick_on_category_menu(){

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Categorías')
                ->screenshot('example-test');
        });

    }
}
