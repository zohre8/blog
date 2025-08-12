<?php
namespace App\Services;
use App\Models\Photo;
use App\Models\Post;
use App\DTOs\PostDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostService extends BaseService
{
    public function __construct(){
        $this->model = new Post();
    }

    public function CreatePost(PostDTO $dto)
    {

        return DB::transaction(function () use ($dto){
            $photo = null;

            if ($dto->photo) {
                $file = $dto->photo;
                $name = time() . '_' .Str::uuid().$file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = Auth::id();
                $photo->save();
            }

            $data_slug = $dto->slug ? make_slug($dto->slug) : make_slug($dto->title);

            $post = $this->create([
                'title' => $dto->title,
                'description' => $dto->description,
                'slug' => $data_slug,
                'meta_description' => $dto->meta_description,
                'meta_title' => $dto->meta_title,
                'is_published' => $dto->is_published,
                'category_id'=>$dto->categories,
                'user_id' => Auth::id(),
                'photo_id' => $photo->id ?? null,

            ]);

            // $post->categories()->sync($dto->categories);
            return $post;
        });
    }

    public function PostUpdate(PostDTO $dto,$id)
    {
        return DB::transaction(function () use ($id,$dto){
            $post=$this->find($id);

            if ($dto->photo && $post->photo_id) {
                $oldPhoto = Photo::find($post->photo_id);
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
                $name = time() . '_'.Str::uuid().$file->getClientOriginalName();
                $file->move(public_path('images'), $name);

                $photo = new Photo();
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = Auth::id();
                $photo->save();
            }
            $data_slug = $dto->slug ? make_slug($dto->slug) : make_slug($dto->title);
            $this->update($post,[
                'title' =>$dto->title,
                'description' =>$dto->description,
                'slug' =>$data_slug,
                'meta_description' =>$dto->meta_description,
                'meta_title' =>$dto->meta_title,
                'is_published' => $dto->is_published,
                'category_id'=>$dto->categories,
                'user_id' => Auth::id(),
                'photo_id' =>$photo->id ?? $post->photo_id,
            ]);
            return $post;
        });
    }

    public function PostDelete($id)
    {
        $post=$this->find($id);
        return $post->delete();
    }
}
