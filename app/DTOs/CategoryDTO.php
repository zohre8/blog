<?php
namespace App\DTOs;

use Illuminate\Http\Request;

class CategoryDTO
{
    public string $name;
    public string $slug;
    public ?string $parent_id;
    public ?string $description;


    public function __construct(
        string $name,
        string $slug,
        ?string $parent_id = null,
        ?string $description = null

    ) {
        $this->name = $name;
        $this->slug = $slug;
        $this->parent_id = $parent_id;
        $this->description =$description;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name'),
            slug: $request->input('slug'),
            parent_id:$request->input('parent_id'),
            description:$request->input('description'),
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'slug'        => $this->slug,
            'parent_id'   =>$this->parent_id,
            'description' =>$this->description,
        ];
    }
}
