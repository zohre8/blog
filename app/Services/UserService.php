<?php
namespace App\Services;
use App\Models\Photo;
use App\Models\User;
use App\DTOs\UserDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;


class UserService extends BaseService
{
    public function __construct(){
        $this->model = new User();
    }

    public function createUser(UserDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            $status = $dto->status ?? '0';

            $user = $this->create([
                'name'        => $dto->name,
                'email'       => $dto->email,
                'phone'       => $dto->phone,
                'birth_date'  => $dto->birth_date,
                'password'    => $dto->password,
                'status'      => $status,
            ]);

            if ($dto->photo) {
                $file = $dto->photo;
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = $user->id;
                $photo->save();

                $user->photo_id = $photo->id;
                $user->save();
            }

//            $roles = $dto->roles ?? [Role::where('slug', 'user')->firstOrFail()->id];
//            $user->roles()->attach($roles);
            $roles = $dto->roles ?? ['user'];
            $user->assignRole($roles);
            return $user;
        });
    }

    public function updateUser( $id ,UserDTO $dto)
    {
        return DB::transaction(function () use ($id, $dto) {
            $user = $this->find($id);

             $this->update($user, [
                 'name'        => $dto->name,
                 'email'       => $dto->email,
                 'phone'       => $dto->phone,
                 'birth_date'  => $dto->birth_date,
                 'status'      => $dto->status ?? 0,
                 ]+($dto->password ? ['password' => $dto->password] : []));

            if ($dto->photo) {
                $file = $dto->photo;
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = $user->id;
                $photo->save();

                $user->photo_id = $photo->id;
                $user->save();
            }
            $roles = $dto->roles ?? ['user'];
            $user->assignRole($roles);
//            $roles = $dto->roles ?? [Role::where('slug', 'user')->firstOrFail()->id];
//            $user->roles()->sync($roles);

            return $user;
        });
    }

    public function deleteUser($id)
    {
     //  return DB::transaction(function () use($id){
        $user = $this->find($id);

        if ($user->photo_id) {
            $photo = Photo::find($user->photo_id);

            if ($photo) {
                $photoPath = public_path('images/' . $photo->path);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }

                $photo->delete();
            }
        }

        return $user->delete();
       //});
    }
}
