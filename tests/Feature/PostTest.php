<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function loginAsAdmin()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $write=Permission::create(['name'=>'write_posts']);
        $edit=Permission::create(['name'=>'edit_post']);
        $active=Permission::create(['name'=>'edit_active']);

        $role = Role::findOrCreate('admin', 'web');
        $role->givePermissionTo([$write,$edit,$active]);
        $user=User::factory()->create();
        $user->assignRole($role);
        $user->markEmailAsVerified();
        $this->actingAs($user);

        return $user;
    }

    public function loginAsAuthor()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $write=Permission::firstOrCreate(['name'=>'write_posts']);

        $role = Role::findOrCreate('author', 'web');
        $role->givePermissionTo($write);
        $user=User::factory()->create();
        $user->assignRole($role);
        $user->markEmailAsVerified();
        $this->actingAs($user);

        return $user;
    }

    public function test_Post_list_displays_existing_posts()
    {
        $this->loginAsAdmin();
        $posts=Post::factory()->count(10)->create();
        $response=$this->get(route('post'));
        $response->assertOk();
        foreach ($posts as $post){
            $response->assertSeeText($post->title);
            $response->assertSeeText('ویرایش');
            $response->assertSeeText('حذف');
        }
    }

    public function test_Post_list_shows_empty_message_when_no_posts_exist()
    {
        $this->loginAsAdmin();
        $response=$this->get(route('post'));
        $response->assertOk();
        $response->assertSeeText('هیچ پستی تا کنون منتشر نشده');
    }

    public function test_author_can_only_see_post_titles()
    {
        $this->loginAsAuthor();

        $posts=Post::factory()->count(10)->create();
        $response=$this->get(route('post'));
        $response->assertOk();
        foreach ($posts as $post){
            $response->assertSeeText($post->title);
            $response->assertDontSee('ویرایش');
            $response->assertDontSee('حذف');
        }
    }
    public function test_author_list_shows_empty_message_when_no_posts_exist(){
        $this->loginAsAuthor();

        $response=$this->get(route('post'));
        $response->assertOk();
        $response->assertSeeText('هیچ پستی تا کنون منتشر نشده');
    }

    public function test_admin_create_post()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        Storage::fake('public');
        Carbon::setTestNow(now());

        $this->loginAsAdmin();
        $user = auth()->user();
        $category = Category::factory()->create();

        $photo = UploadedFile::fake()->image('test.jpg');
        $postData = [
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'photo_id' => $photo,
            'category_id' => $category->id,
            'is_published' => 0,
        ];

        $response = $this->post(route('post.store'), $postData);
        $response->assertRedirect();
        $this->assertDatabaseCount('posts', 1);
    }

    public function test_author_create_post()
    {
        $this->loginAsAuthor();
        Storage::fake('public');
        Carbon::setTestNow(now());
        $category=Category::factory()->create();
        $user=auth()->user();

        $photo=UploadedFile::fake()->image('test1.png');
        $post=[
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'photo_id' => $photo,
            'category_id' => $category->id,
            'is_published' => 0,
        ];

        $response = $this->post(route('post.store'), $post);
        $response->assertRedirect();
        $this->assertDatabaseCount('posts', 1);
    }

    public function test_guest_cannot_create_post(){
        Storage::fake('public');
        Carbon::setTestNow(now());

        $category=Category::factory()->create();
        $photo=UploadedFile::fake()->image('test.png');
        $post=[
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'photo_id' => $photo,
            'category_id' => $category->id,
            'is_published' => 0,
        ];
        $response=$this->post(route('post.store'),$post);
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_authenticated_user_without_proper_role_cannot_create_post()
    {
        Storage::fake('public');
        Carbon::setTestNow(now());

        $category=Category::factory()->create();
        $user=User::factory()->create();
        $this->actingAs($user);

        $photo=UploadedFile::fake()->image('test1.png');
        $post=[
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'photo_id' => $photo,
            'category_id' => $category->id,
            'is_published' => 0,
        ];
        $response=$this->post(route('post.store'),$post);
        $response->assertForbidden();
    }

    public function test_admin_update_post()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        Storage::fake('public');
        Carbon::setTestNow(now());

        $this->loginAsAdmin();
        $user = auth()->user();

        $category = Category::factory()->create();

        $photoModel = Photo::create([
            'name' => 'test2.png',
            'path' => 'fake_path/test2.png',
            'user_id' => $user->id,
        ]);

        $post = Post::factory()->create([
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'photo_id' => $photoModel->id,
            'category_id' => $category->id,
            'is_published' => 0,
        ]);

        $response = $this->put(route('post.update', $post->id), [
            'title' => 'Update Test posts',
            'slug' => make_slug('Test posts Update'),
            'description' => 'A test posts Update',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => 0,

        ]);

        $response->assertRedirect();
        $response->assertStatus(302);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Update Test posts',
            'slug' => make_slug('Test posts Update'),
            'description' => 'A test posts Update',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'photo_id' => $photoModel->id,
            'category_id' => $category->id,
            'is_published' => 0,
        ]);
    }

    public function test_authenticated_user_without_proper_role_cannot_update_post()
    {
        Storage::fake('public');
        Carbon::setTestNow(now());

        $category=Category::factory()->create();
        $user=User::factory()->create();
        $this->actingAs($user);
        $photoModel=Photo::create([
            'name' => 'test2.png',
            'path' => 'fake_path/test2.png',
            'user_id' => $user->id,
        ]);
        $post=Post::factory()->create([
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'photo_id' => $photoModel->id,
            'category_id' => $category->id,
            'is_published' => 0,
        ]);

        $response=$this->put(route('post.update',$post->id),[
            'title' => 'Update Test posts',
            'slug' => make_slug('Test posts Update'),
            'description' => 'A test posts Update',
            'meta_title' => null,
            'meta_description' => null,
            'user_id' => $user->id,
            'category_id' => $category->id,
            'is_published' => 0,
        ]);

        $response->assertForbidden();
    }

    public function test_guest_cannot_update_post()
    {
        Storage::fake('public');
        Carbon::setTestNow(now());

        $category=Category::factory()->create();


        $post=Post::factory()->create([
            'title' => 'Test posts',
            'slug' => make_slug('Test posts'),
            'description' => 'A test posts',
            'meta_title' => null,
            'meta_description' => null,
            'photo_id' => null,
            'category_id' => $category->id,
            'is_published' => 0,
        ]);
        $response=$this->put(route('post.update',$post->id),[
               'title' => 'Update Test posts',
               'slug' => make_slug('Test posts Update'),
               'description' => 'A test posts Update',
               'meta_title' => null,
               'meta_description' => null,
               'category_id' => $category->id,
               'is_published' => 0,
           ]) ;
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_admin_can_soft_delete_post()
    {
        $this->loginAsAdmin();
        $post=Post::factory()->create();
        $response=$this->delete(route('post.destroy', $post->id));
        $response->assertRedirect();
        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts',['id'=>$post->id]);
    }

    public function test_guest_cannot_delete_soft_pest()
    {
        $post=Post::factory()->create();
        $response=$this->delete(route('post.destroy', $post->id));
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_authenticated_user_without_proper_role_cannot_delete_post(){
        $user=User::factory()->create();
        $this->actingAs($user);
        $post=Post::factory()->create();
        $response=$this->delete(route('post.destroy', $post->id));
        $response->assertForbidden();
    }
}
