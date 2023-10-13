<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){

        $customer = Customer::with('addresses')->get();
        return ResponseFormatter::success(
            $customer,
            'Data list customer berhasil diambil'
        );
    }

    public function store (CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->validated());
            if (!$customer) {
                throw new Exception('Customer not created');
            }
            return ResponseFormatter::success($customer, 'Customer created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(CustomerRequest $request,$id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                throw new Exception('Customer not found');
            }
            $customer->update($request->validated());

            return ResponseFormatter::success($customer, 'Customer updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $customer = Customer::find($id);
            if (!$customer) {
                throw new Exception('Customer not found');
            }
            $customer->delete();

            return ResponseFormatter::success(null,'Customer deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

}
