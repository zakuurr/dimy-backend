<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;

class TransactionController extends Controller
{
    public function index(){

        $transactions = Transaction::all();
        return ResponseFormatter::success(
            $transactions,
            'Data list transactions berhasil diambil'
        );
    }

    public function store (TransactionRequest $request)
    {
        try {
            $transaction = Transaction::create($request->validated());
            if (!$transaction) {
                throw new Exception('Transaction not created');
            }
            return ResponseFormatter::success($transaction, 'Transaction created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(TransactionRequest $request,$id)
    {
        try {
            $transaction = Transaction::find($id);
            if (!$transaction) {
                throw new Exception('Transaction not found');
            }
            $transaction->update($request->validated());

            return ResponseFormatter::success($transaction, 'Transaction updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $transactions = Transaction::find($id);
            if (!$transactions) {
                throw new Exception('Transaction not found');
            }

            $transactionDetailsCount = TransactionDetail::where('transaction_id', $transactions->id)->count();

            if ($transactionDetailsCount > 0) {
                throw new Exception('Transaction cannot be deleted because it has associated details');
            }

            $transactions->delete();

            return ResponseFormatter::success(null,'Transaction deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
