<?php

namespace App\Repositories;

interface ClientRepositoryInterface
{
    public function all();

    public function find($id);

    public function create($customer);

    public function update($customer);

    public function delete($id);
}
