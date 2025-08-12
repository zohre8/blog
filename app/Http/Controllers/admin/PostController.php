<?php

namespace App\Http\Controllers\admin;

use App\DTOs\PostDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use AuthorizesRequests;
    private PostService $postService ;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts= Post::with('user','category')->get();
        $user=auth()->user();
        $permissions = $user->getAllPermissions();
        return view('admin.post.index',compact(['posts','permissions']));
    }

    public function show($id)
    {
        $post= Post::with('user','category')->findOrFail($id);
        return view('admin.post.show',compact(['post']));
    }

    public function create()
    {
        $categories= Category::where('parent_id',null)->get();
        $user=auth()->user();
        $permissions = $user->getAllPermissions();
       return view('admin.post.create',compact(['categories','permissions']));
    }

    public function store(PostRequest $request)
    {
        $this->authorize('create', Post::class);
        try {
            $dto=PostDTO::fromRequest($request);

            $post =$this->postService->CreatePost($dto);
             return redirect()->route('post.create')->with('success', 'مطلب شما با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            throw $e;
            //return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $categories=Category::where('parent_id',null)->get();
        $post=Post::findOrFail($id);

        return view('admin.post.edit',compact(['categories','post']));
    }

    public function update(PostRequest $request,$id)
    {
        try {
            $dto=PostDTO::fromRequest($request);
            $post=$this->postService->PostUpdate($dto, $id);

            return redirect()->route('post.edit',$id)->with('success', 'مطلب شما با موفقیت ویرایش شد.');
        }catch (\Exception $e){
            return back()->withErrors(['error'=> $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $post=$this->postService->PostDelete($id);
            return redirect()->route('post')->with('success', 'مطلب شما با موفقیت حذف شد.');
        }catch (\Exception $e){
            return back()->withErrors(['erroe'=> $e->getMessage()]);
        }
    }
}
