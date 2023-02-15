<?php

namespace Tests\Feature;

use App\Http\Controllers\WelcomeController;
use App\Http\Livewire\CategoryProducts;
use App\Http\Livewire\Navigation;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class Semana2Test extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function the_see_Login_and_Register_while_not_logged_in()
    {
        Category::factory()->create();

        $response = $this->get('/');

        $response->assertSee('Iniciar sesión');
        $response->assertSee('Registrarse');
    }

    /** @test **/
    public function the_see_Login_and_Register_while_logged_in()
    {
        $user = User::factory()->create();
        Category::factory()->create();


        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->get('/');

        $response->assertSee('Perfil');
        $response->assertSee('Finalizar sesión');
        $this->assertAuthenticated();
    }

    /** @test **/
    public function the_see_5_products()
    {
        $category = Category::factory()->create();
        $subcategory =  Subcategory::factory()->create();
        $brand = Brand::factory()->create();
        $brand->categories()->attach($category->id);

        for ($i = 0; $i < 5; $i++){
            $product = Product::factory()->create([
                'subcategory_id' => $subcategory->id,
                'brand_id' => $brand->id,
                'name' => 'Producto ' . $i,
            ]);
            Image::factory()->create([
                'imageable_id' => $product->id,
                'imageable_type' => Product::class
            ]);
            $products[] = $product;
        }


        Livewire::test(CategoryProducts::class , ['category' => $category])
            ->assertSee($products[0]->name)
            ->assertSee($products[1]->name)
            ->assertSee($products[2]->name)
            ->assertSee($products[3]->name)
            ->assertSee($products[4]->name);
    }


    /** @test **/
    public function the_see_1_and_no_seed_1_products()
    {
        $category = Category::factory()->create();
        $subcategory =  Subcategory::factory()->create();
        $brand = Brand::factory()->create();
        $brand->categories()->attach($category->id);

            $product01 = Product::factory()->create([
                'subcategory_id' => $subcategory->id,
                'brand_id' => $brand->id,
                'name' => 'Producto 1',
            ]);
            Image::factory()->create([
                'imageable_id' => $product01->id,
                'imageable_type' => Product::class
            ]);
            $products[] = $product01;


        $product02 = Product::factory()->create([
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brand->id,
            'name' => 'Producto 2',
        ]);
        Image::factory()->create([
            'imageable_id' => $product02->id,
            'imageable_type' => Product::class
        ]);

        $products[] = $product02;


        Livewire::test(CategoryProducts::class , ['category' => $category])
            ->assertSee($products[0]->name)
            ->assertDontSee($products[1]->name);
    }

}
