<?php
namespace App\Services;
use App\DTOs\SitePageDTO;
use App\Models\Category;
use App\Models\Photo;
use App\Models\SitePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SitePageService extends BaseService
{
    public function __construct(){
        $this->model = new SitePage();
    }

    public function SiteCreate(SitePageDTO $dto)
    {
        return DB::transaction(function () use ($dto){
            $photo = null;

            if ($dto->photo) {
                $file = $dto->photo;
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = Auth::id();
                $photo->save();
            }

            $sitePage = $this->create([
                'title' => $dto->title,
                'slug' => $dto->slug,
                'content' => $dto->content,
                'photo_id '=>$photo->id ?? null,
            ]);

            return $sitePage;
        });
    }

    public function SiteUpdate($id , SitePageDTO $dto)
    {
        return DB::transaction(function () use ($id, $dto){

            $sitePage=$this->find($id);
            if ($dto->photo && $sitePage->photo_id) {
                $oldPhoto = Photo::find($sitePage->photo_id);
                if ($oldPhoto) {
                    $filePath = public_path('images/' . $oldPhoto->path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $oldPhoto->delete();
                }
            }
            if ($dto->photo) {
                $file = $dto->photo;
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = Auth::id();
                $photo->save();
            }
            $this->update($sitePage,[
                'title' => $dto->title,
                'slug' => $dto->slug,
                'content' => $dto->content,
                'photo_id' =>$photo->id ?? $sitePage->photo_id,
            ]);

            return $sitePage;
        });
    }


}
