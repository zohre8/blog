<?php

namespace App\Http\Controllers\admin;

use App\DTOs\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = Category::with('parent')->orderBy('id','asc')->get();
        return view('admin.category.index',compact(['categories']));
    }

    public function create()
    {
        $categories=Category::where('parent_id',null)->get();
        return view('admin.category.create',compact(['categories']));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $dto=CategoryDTO::fromRequest($request);
            $category = $this->categoryService->CategoryCreate($dto);

            return redirect()->route('category.create')->with('success', 'دسته با موفقیت ثبت شد.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
       $category=Category::findOrFail($id);
       $categories=Category::where('parent_id',null)->get();
        return view('admin.category.edit',compact(['category','categories']));
    }

    public function update(CategoryRequest $request,$id)
    {
        try {
            $dto=CategoryDTO::fromRequest($request);
            $category=$this->categoryService->CategoryUpdate($id,$dto);

            return redirect()->route('category.edit', $id)->with('success', 'دسته با موفقیت ویرایش شد.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryService->CategoryDelete($id);
            return redirect()->route('category')->with('success', 'دسته با موفقیت حذف شد.');

        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
