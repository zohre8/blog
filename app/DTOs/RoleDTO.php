<?php
namespace App\DTOs;

use Illuminate\Http\Request;

class RoleDTO
{
    public string $name;
    public string $guard_name;


    public function __construct(
        string $name,
        string $guard_name

    ) {
        $this->name = $name;
        $this->guard_name = $guard_name;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            guard_name: $request->input('guard_name')
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'guard_name'       => $this->guard_name,
        ];
    }
}
