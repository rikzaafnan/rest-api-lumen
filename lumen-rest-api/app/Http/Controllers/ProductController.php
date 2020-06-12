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
        $this->validate($request, [
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'warna' => 'required|string',
            'kondisi' => 'required|in:baru,lama',
            'deskripsi' => 'string',
            'uuid' => 'string'
        ]);
        
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

    public function show(Request $request, $productId)
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

    public function update(Request $request, $productId)
    {
        $product = Product::where('id', $productId)->first();

        if(!$product) {
            $response = [
                'message' => [
                    'text' => 'Data tidak ditemukan',
                ],
                'code' => 500,
            ];

            return response()->json($response, $response['code']);
        }

        $data = $request->all();

        $product->fill($data);
        
        if($product) {
            $response = [
                'message' => [
                    'text' => 'Success',
                ],
                'code' => 200,
                'data' => $data,
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
      

        $product = Product::where('id', $productId)->delete();

        if(!$product) {
            $response = [
                'message' => [
                    'text' => 'Data Tidak ada',
                ],
                'code' => 500,
            ];
            return response()->json($response, $response['code']);

        } 

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
