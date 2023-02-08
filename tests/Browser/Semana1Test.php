<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Semana1Test extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function click_on_categories_and_see()
    {
       $category =  Category::factory()->create();
        Subcategory::factory()->create();

        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/')
                ->assertVisible('#category')
                ->click('#category')
                    ->assertSee($category->name);
        });
    }

    /** @test */
    public function click_on_categories_and_see_subcategory()
    {
        $categoria01 = Category::factory()->create();
        $categoria02 = Category::factory()->create();
       $subCategory01 = Subcategory::factory()->create([
           'category_id' => $categoria01->id,
       ]);
       $subCategory02 = Subcategory::factory()->create([
           'category_id' => $categoria02->id,
       ]);

        $this->browse(function (Browser $browser) use ($categoria02 ,$subCategory01, $subCategory02) {
            $browser->visit('/')
                ->assertVisible('#category')
                ->click('#category')
                ->mouseover('@category_' . $categoria02->id)
                ->assertSee($subCategory02->name)
            ->screenshot('pincha');
        });
    }
}
