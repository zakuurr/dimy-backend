<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\PaymentMethodRequest;
use App\Http\Requests\ProductRequest;
use App\Models\PaymentMethod;
use App\Models\Product;
use Exception;

class PaymentMethodController extends Controller
{
    public function index(){

        $payments = PaymentMethod::all();
        return ResponseFormatter::success(
            $payments,
            'Data list payment method berhasil diambil'
        );
    }

    public function store (PaymentMethodRequest $request)
    {
        try {
            $payments = PaymentMethod::create($request->validated());
            if (!$payments) {
                throw new Exception('Payment not created');
            }
            return ResponseFormatter::success($payments, 'Payment created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(PaymentMethodRequest $request,$id)
    {
        try {
            $payment = PaymentMethod::find($id);
            if (!$payment) {
                throw new Exception('Payment Method not found');
            }
            $payment->update($request->validated());

            return ResponseFormatter::success($payment, 'Payment Method updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $payments = PaymentMethod::find($id);
            if (!$payments) {
                throw new Exception('Payment Method not found');
            }
            $payments->delete();

            return ResponseFormatter::success(null,'Payment Method deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
