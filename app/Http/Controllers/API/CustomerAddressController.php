<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddressRequest;
use App\Models\CustomerAddress;
use Exception;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    public function index(){

        $customer = CustomerAddress::with(['customer'])->get();
        return ResponseFormatter::success(
            $customer,
            'Data list customer address berhasil diambil'
        );
    }

    public function store (CustomerAddressRequest $request)
    {
        try {
            $customeraddress = CustomerAddress::create($request->validated());
            if (!$customeraddress) {
                throw new Exception('Customer Address not created');
            }
            return ResponseFormatter::success($customeraddress, 'Customer Address created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(CustomerAddressRequest $request,$id)
    {
        try {
            $customeraddress = CustomerAddress::find($id);
            if (!$customeraddress) {
                throw new Exception('Customer address not found');
            }
            $customeraddress->update($request->validated());

            return ResponseFormatter::success($customeraddress, 'Customer address updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $customeraddress = CustomerAddress::find($id);
            if (!$customeraddress) {
                throw new Exception('Customer address not found');
            }
            $customeraddress->delete();

            return ResponseFormatter::success(null,'Customer address deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
