<?php
namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class SitePageDTO
{
    public string $slug;
    public string $title;
    public ?string $content;
    public ?UploadedFile $photo;

    public function __construct(
        string $slug,
        string $title,
        ?string $content = null,
        ?UploadedFile $photo = null,

    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->content = $content;
        $this->photo =$photo;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            slug: $request->input('slug'),
            content:$request->input('content'),
            photo:$request->file('photo_id')
        );
    }

    public function toArray(): array
    {
        return [
            'title'        => $this->title,
            'slug'        => $this->slug,
            'content'   =>$this->content,

        ];
    }
}
