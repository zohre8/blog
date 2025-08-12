<?php
namespace App\Services;
use App\DTOs\CategoryDTO;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CategoryService extends BaseService
{
    public function __construct(){
        $this->model = new Category();
    }

    public function CategoryCreate(CategoryDTO $dto)
    {
        return DB::transaction(function () use($dto){
            $category = $this->create([
                'name' => $dto->name,
                'slug' => $dto->slug,
                'parent_id' => $dto->parent_id,
                'description' => $dto->description
            ]);

            return $category;
        });
    }

    public function CategoryUpdate($id , CategoryDTO $dto)
    {
        return DB::transaction(function () use ($id, $dto){
            $category=$this->find($id);
            $this->update($category,[
                'name' => $dto->name,
                'slug' => $dto->slug,
                'parent_id' => $dto->parent_id,
                'description' => $dto->description
            ]);

            return $category;
        });
    }

    public function CategoryDelete($id)
    {
            $cat=$this->find($id);
            return $cat->delete();
    }
}
