<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionDetailRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;

class TransactionDetailController extends Controller
{
    public function index(){

        $detail = TransactionDetail::with(['transaction','product','payment'])->get();
        return ResponseFormatter::success(
            $detail,
            'Data detail berhasil diambil'
        );
    }

    public function store (TransactionDetailRequest $request)
    {
        try {
            $transaction = TransactionDetail::create($request->validated());
            if (!$transaction) {
                throw new Exception('Transaction Detail not created');
            }
            return ResponseFormatter::success($transaction, 'Transaction Detail created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(TransactionDetailRequest $request,$id)
    {
        try {
            $transaction = TransactionDetail::find($id);
            if (!$transaction) {
                throw new Exception('Transaction Detail not found');
            }
            $transaction->update($request->validated());

            return ResponseFormatter::success($transaction, 'Transaction Detail updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $transactions = TransactionDetail::find($id);
            if (!$transactions) {
                throw new Exception('Transaction Detail not found');
            }

            $transactions->delete();

            return ResponseFormatter::success(null,'Transaction Detail deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
