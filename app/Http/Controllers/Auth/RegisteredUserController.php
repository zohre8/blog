<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Services\UserService;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {

        try {

            $dto = UserDTO::fromRequest($request); // 👈 فقط همین

            $user = $this->userService->createUser($dto);


            event(new Registered($user));
            Auth::login($user);

            return redirect()->route('dashboard')
                ->with('success', 'ثبت‌نام با موفقیت انجام شد.');
        } catch (\Exception $e) {
            \Log::error('❌ خطا در ثبت کاربر:', ['msg' => $e->getMessage()]);
            return back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
