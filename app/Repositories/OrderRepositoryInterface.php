<?php

namespace App\Repositories;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Services\ReportService;

interface OrderRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(OrderStoreRequest $request);

    public function update(OrderUpdateRequest $request, $id);

    public function delete($id);

    public function sendmail($id);

    public function report(ReportService $reportService, $id);
}
