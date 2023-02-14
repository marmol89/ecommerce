<?php

namespace Tests\Feature;

use App\Http\Livewire\Navigation;
use App\Models\Brand;
use App\Models\Category;
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
        Subcategory::factory()->create();

        $response = $this->get('/');

        $response->assertSee('Iniciar sesión');
        $response->assertSee('Registrarse');
    }

    /** @test **/
    public function the_see_Login_and_Register_while_logged_in()
    {
        $user = User::factory()->create();
        Category::factory()->create();
        Subcategory::factory()->create();


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
        $products[] = [];
        for ($i = 0; $i < 5; $i++){
            $products[] += Product::factory()->create([
                'subcategory_id' => $subcategory->id,
                'brand_id' => $brand->id,
                'name' => 'Producto ' . $i,
            ]);
        }



        Livewire::test(Navigation::class , ['category' => $category->name])
            ->set(Product::class ,$products);
    }

}
