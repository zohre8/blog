<?php
namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class PostDTO

{
    public string $title;
    public ?string $slug;
    public string $description;
    public ?string $meta_description;
    public ?string $meta_title;
    public ?UploadedFile $photo;
    public ?string $categories;
    public ?string $is_published;

    public function __construct(
        string $title,
        ?string $slug= null,
        string $description,
        ?string $meta_description= null,
        ?string $meta_title= null,
        ?string $is_published= null,
        ?UploadedFile $photo= null,
        ?string $categories = null
    )
    {
        $this->title = $title ;
        $this->slug = $slug;
        $this->description = $description;
        $this->meta_description =$meta_description;
        $this->meta_title =$meta_title;
        $this->photo = $photo;
        $this->categories = $categories;
        $this->is_published =$is_published;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            slug: $request->input('slug'),
            description: $request->input('description'),
            meta_description: $request->input('meta_description'),
            meta_title: $request->input('meta_title'),
            photo: $request->file('photo_id'),
            categories: $request->input('category_id'),
            is_published: $request->input('is_published')
        );
    }

    public function toArray() :array
    {
        return [
            'title' => $this->title ,
            'description' => $this->description ,
            'slug' => $this->slug,
            'meta_description' => $this->meta_description,
            'meta_title' => $this->meta_title,
            'photo' => $this->photo,
            'categories' => $this->categories,
            'is_published' => $this->is_published,
        ];
    }


}
