<?php

namespace App\Http\Controllers\admin;

use App\DTOs\RoleDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class
RolleController extends Controller
{

    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService =$roleService;
    }

    public function index()
    {
        $roles=Role::orderBy('id','asc')->get();
        return view('admin.role.index',compact(['roles']));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(RoleRequest $request)
    {
       // dd($request->all());
        try {
            $dto=RoleDTO::fromRequest($request);
            $role=$this->roleService->RoleCreate($dto);
            return redirect()->route('role.create')->with('success', 'نقش با موفقیت ثبت شد.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $role=Role::findOrFail($id);
        return view('admin.role.edit',compact(['role']));
    }

    public function update(RoleRequest $request,string $id)
    {
        try {
            $dto= RoleDTO::fromRequest($request);
            $role=$this->roleService->RoleUpdate($id,$dto);

            return redirect()->route('role.edit', $id)->with('success', 'نقش با موفقیت ویرایش شد.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
           $role=$this->roleService->RoleDelete($id);
            return redirect()->route('role')->with('success', 'نقش با موفقیت حذف شد.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
