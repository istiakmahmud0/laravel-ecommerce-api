<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll(?int $limit, ?array $relationShipNames): Collection;
    public function store(array $details): Model;
    public function findById(string $id, array $relationNames): Model;
    public function update(Model $model, array $newDetails): bool;
    public function delete(Model $model): bool;
}
