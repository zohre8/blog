<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function loginAsAdmin()
    {

        $role=Role::create([
            'name'=>'admin',
            'guard_name'=>'web'
        ]);
        $permission=Permission::create(['name'=>'create_category']);
        $user = User::factory()->create();
        $role->givePermissionTo($permission);
        $user->assignRole($role);
        $user->markEmailAsVerified();
        $this->actingAs($user);

        return $user;
    }

    public function test_category_list_displays_existing_categories()
    {
        $this->loginAsAdmin();
        $categories=Category::factory()->count(3)->create();
        $response=$this->get(route('category'));

        $response->assertOk();
       foreach ($categories as $category){
           $response->assertSeeText($category->name);
       }
    }

    public function test_category_list_shows_empty_message_when_no_categories_exist()
    {
        $this->loginAsAdmin();

        $response=$this->get(route('category'));
        $response->assertOk();
        $response->assertSeeText('دسته‌بندی‌ای وجود ندارد');
    }
    public function test_authenticated_admin_user_can_create_a_category()
    {
        $this->loginAsAdmin();
      $category=[
          'name'=>'Test Category',
          'slug'=>'Test_Category',
          'description'=>'A test category',
          'parent_id'=>null
      ];
      $response =$this->post(route('category.store'),$category);
        $response->assertRedirect();
        $this->assertDatabaseHas('categories',[
            'name'=>'Test Category',
            'slug'=>'Test_Category',
            'description'=>'A test category',
            'parent_id'=>null
        ]);

    }

    public function test_guest_cannot_create_category()
    {
        $response=$this->post(route('category.store'),[
            'name'=>'Test Category',
            'slug'=>'Test_Category',
            'description'=>'A test category',
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_without_proper_role_cannot_create_category()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $response=$this->post(route('category.store'),[
            'name'=>'Test Category',
            'slug'=>'Test_Category',
            'description'=>'A test category',
        ]);

        $response->assertStatus(403);
    }

    public function test_create_category_fails_when_required_fields_are_missing()
    {
        $this->loginAsAdmin();
        $category=[
            "name"=>'',
        ];

        $response=$this->post(route('category.store'),$category);
        $response->assertSessionHasErrors(['name','slug']);
    }

    public function test_authenticated_admin_can_update_category()
    {
        $this->loginAsAdmin();

        $category=Category::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-slug',
            'description' => 'Old description'
        ]);

        $respose=$this->put(route('category.update',$category->id),[
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
            'description' => 'Updated description',
            'parent_id' => null
        ]);

        $respose->assertRedirect();
        $respose->assertStatus(302);
        $this->assertDatabaseHas('categories',[
            'id' => $category->id,
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
            'description' => 'Updated description'
        ]);
    }

    public function test_guest_cannot_update_category()
    {
        $category=Category::factory()->create();
        $responce=$this->put(route('category.update',$category->id),[
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
        ]);

        $responce->assertRedirect(route('login'));
    }

    public function test_user_without_role_cannot_update_category()
    {
        $user=User::factory()->create();
        $this->actingAs($user);

        $category=Category::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-slug',
            'description' => 'Old description'
        ]);

        $responce=$this->put(route('category.update',$category->id),[
            'name' => 'Updated Name',
            'slug' => 'updated-slug',
            'description' => 'Updated description',
            'parent_id' => null
        ]);

        $responce->assertStatus(403);
    }
    public function test_authenticated_admin_can_delete_category()
    {
        $this->loginAsAdmin();

        $category=Category::factory()->create();
        $response=$this->delete(route('category.destroy',$category->id));
        $response->assertRedirect();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories',[
            'id'=>$category->id
        ]);
    }

    public function test_guest_cannot_delete_category()
    {
        $category=Category::factory()->create();
        $responce=$this->delete(route('category.destroy',$category->id));
        $responce->assertRedirect(route('login'));
    }

    public function test_user_without_role_cannot_delete_category()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $category=Category::factory()->create();
        $responce=$this->delete(route('category.destroy',$category->id));

        $responce->assertStatus(403);
    }
}
