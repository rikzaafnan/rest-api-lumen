<?php

namespace App\Http\Controllers;

use App\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $products = Product::get();

        if($products) {
            $response = [
                'message' => [
                    'text' => 'Success',
                ],
                'code' => 200,
                'data' => $products,
            ];
        } else {
            $response = [
                'message' => [
                    'text' => 'Data kosong',
                ],
                'code' => 500,
            ];
        }

        return response()->json($response, $response['code']);

    }

    public function store(Request $request)
    {
        $data = $request->all();

        $product = Product::create($data);

        $response = [
            'message' => [
                'text' => 'Success',
            ],
            'code' => 200,
            'data' => $product,
        ];

        return response()->json($response, $response['code']);
    }

    public function update(Request $request, $productId)
    {
        $product = Product::where('id', $productId)->first();
        
        if($product) {
            $response = [
                'message' => [
                    'text' => 'Success',
                ],
                'code' => 200,
                'data' => $product,
            ];
        } else {
            $response = [
                'message' => [
                    'text' => 'Data kosong',
                ],
                'code' => 500,
            ];
        }

        return response()->json($response, $response['code']);
    }

    public function destroy($productId)
    {
        if(!$productId) {
            $response = [
                'message' => [
                    'text' => 'Data Tidak ada',
                ],
                'code' => 500,
            ];
        } 

        $product = Product::where('id', $productId)->delete();

        if($product) {
            $response = [
                'message' => [
                    'text' => 'Success deleted',
                ],
                'code' => 200,
            ];
        } else {
            $response = [
                'message' => [
                    'text' => 'Gagal menghapus',
                ],
                'code' => 422,
            ];
        }

        return response()->json($response, $response['code']);

    }
}
