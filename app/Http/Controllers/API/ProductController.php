<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(Request $request)
    {
         $id          = $request->input('id');
         $limit       = $request->input('limit');
         $name        = $request->input('name');
         $describtion = $request->input('describtion');
         $tags        = $request->input('tags');
         $categories  = $request->input('categories');
         $price_from  = $request->input('price_from');
         $price_to    = $request->input('price_to');


         if ($id) {
             $product = Product::with(['galleries', 'category'])->find($id);
         
            if ($product) {
                return ResponseFormatter::success(
                    $product,
                    'data berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'tidak ada data',
                    '404'
                );
            }
         }

         $product = Product::with(['galleries', 'category']);

         if ($name) {
             $product->where('name','like','%'.$name.'%');
         }

         if ($describtion) {
            $product->where('description','like','%'.$describtion.'%');
        }

        if ($tags) {
            $product->where('tags','like','%'.$tags.'%');
        }

        if ($price_from) {
            $product->where('price', '>=' , $price_from);
        }

        if ($price_to) {
            $product->where('price', '<=', $price_to);
        }

        if ($categories) {
            $product->where('categories',$categories);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'data product berhasil di ambil'
        );
    }
}
