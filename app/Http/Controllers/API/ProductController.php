<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();
        return ResponseFormatter::success(
            $products,
            'Data list product berhasil diambil'
        );
    }

    public function store (ProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());
            if (!$product) {
                throw new Exception('Product not created');
            }
            return ResponseFormatter::success($product, 'Product created');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(ProductRequest $request,$id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                throw new Exception('Product not found');
            }
            $product->update($request->validated());

            return ResponseFormatter::success($product, 'Product updated');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $products = Product::find($id);
            if (!$products) {
                throw new Exception('Product not found');
            }

            $productCount = TransactionDetail::where('product_id', $products->id)->count();

            if ($productCount > 0) {
                throw new Exception('Product cannot be deleted because it has associated details');
            }

            $products->delete();

            return ResponseFormatter::success(null,'Product deleted');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
