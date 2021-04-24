<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();

    public function find($id);

    public function create($customer);

    public function update($customer);

    public function delete($id);
}
