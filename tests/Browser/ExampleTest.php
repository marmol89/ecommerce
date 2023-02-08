<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function basicRecurse()
    {
        Category::factory()->create();
        Subcategory::factory()->create();
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->basicRecurse();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Categorías')
                    ->screenshot('inicio');
        });
    }
}
