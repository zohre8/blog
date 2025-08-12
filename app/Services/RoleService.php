<?php
namespace App\Services;
use App\DTOs\RoleDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;


class RoleService extends BaseService
{
    public function __construct(){
        $this->model = new Role();
    }

    public function RoleCreate(RoleDTO $dto)
    {
        return DB::transaction(function () use ($dto){
            $role=$this->create([
                'name'=> $dto->name,
                'guard_name'=> $dto->guard_name
            ]);
            return $role;
        });
    }

    public function RoleUpdate($id , RoleDTO $dto)
    {
       return DB::transaction(function () use ($id, $dto){
          $role=$this->find($id);
          $this->update($role,[
              'name'=>$dto->name,
              'guard_name'=>$dto->guard_name
          ]);
          return $role;
       });
    }

    public function RoleDelete($id)
    {
        $role=$this->find($id);
        return $role->delete();
    }
}
