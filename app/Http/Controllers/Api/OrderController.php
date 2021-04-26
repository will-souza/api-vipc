<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->all();
    }

    public function store(OrderStoreRequest $request)
    {
        return $this->orderRepository->create($request);
    }

    public function show($id)
    {
        return $this->orderRepository->find($id);
    }

    public function update(OrderUpdateRequest $request, $id)
    {
        return $this->orderRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->orderRepository->delete($id);
    }

    public function sendmail($id)
    {
        //
    }

    public function report(Request $request, $id)
    {
        return $this->orderRepository->report($request, $id);
    }
}
