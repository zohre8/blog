<?php

namespace App\Http\Controllers\admin;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::with('roles')->orderBy('id','asc')->get();
        $user=auth()->user();
        $permissions = $user->getAllPermissions();
        return view('admin.user.index',compact(['users','permissions']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles=Role::all();

        return view('admin.user.creat',compact(['roles']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $dto=UserDTO::fromRequest($request);
            $user=$this->userService->createUser($dto);
            \Log::info('✅ کاربر ذخیره شد:', $user->toArray());
            return redirect()->route('user-creat')->with('success', 'کاربر با موفقیت ثبت شد.');
        } catch (\Exception $e) {
            \Log::error('❌ خطا در ثبت کاربر:', ['msg' => $e->getMessage()]);
            return back()->withErrors(['error' => $e->getMessage()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.user.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user= User::findOrFail($id);
        $roles=Role::all();
        return view('admin.user.edit',compact(['user','roles']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEditRequest $request, string $id)
    {
        try {
            $dto = UserDTO::fromRequest($request);
            $user = $this->userService->updateUser($id, $dto);

            \Log::info('✅ کاربر ویرایش شد:', $user->toArray());
            return redirect()->route('user-edit', $id)->with('success', 'کاربر با موفقیت ویرایش شد.');
        } catch (\Exception $e) {
            \Log::error('❌ خطا در ویرایش کاربر:', ['msg' => $e->getMessage()]);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->userService->deleteUser($id);
            return redirect()->route('user')->with('success', 'کاربر با موفقیت حذف شد.');
        }catch (\Exception $e) {
            \Log::error('❌ خطا در حذف

             کاربر:', ['msg' => $e->getMessage()]);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
