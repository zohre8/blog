<?php
namespace App\DTOs;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Morilog\Jalali\Jalalian;
use Spatie\Permission\Models\Role;


class UserDTO
{
    public string $name;
    public string $email;
    public string $password;
    public ?string $phone;
    public ?string $birth_date;
    public ?string $status;
    public ?array $roles;
    public ?UploadedFile $photo;

    public function __construct(
        string $name,
        string $email,
        string $password,
        ?string $phone = null,
        ?string $birth_date = null,
        ?string $status = null,
        ?array $roles = null,
        ?UploadedFile $photo = null,
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->birth_date = $birth_date;
        $this->status = $status;
        $this->roles = $roles;
        $this->photo = $photo;
    }

    public static function fromRequest(Request $request): self
    {
        $birth_raw = $request->input('birth_date');
        $birth_data_input = $birth_raw ? convertPersianNumbersToEnglish($birth_raw) : null;
        $birth_date_gregorian = $birth_data_input ? Jalalian::fromFormat('Y-m-d', $birth_data_input)->toCarbon()->toDateString() :null ;
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            password: Hash::make($request->input('password')),
            phone: $request->input('phone'),
            birth_date: $birth_date_gregorian,
            status: $request->input('status'),
            roles: $request->filled('role')
                ? Role::whereIn('id', $request->input('role'))->pluck('name')->toArray()
                : null,
            photo: $request->file('photo_id')
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'birth_date'  => $this->birth_date,
            'status'      => $this->status,
            'password'    => $this->password,
        ];
    }
}
