<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Model ;

abstract class BaseService
{
    protected Model $model;

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model;
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

}
