<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all(Request $request)
    {
        $id           = $request->input('id');
        $limit        = $request->input('limit');
        $name         = $request->input('name');
        $show_product = $request->input('show_product');

        if ($id) {
            $category = Category::find($id);

            if ($category) {
                return ResponseFormatter::success(
                    $category,
                    'data category berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'data category tidak ditemukan',
                    '404'
                );
            }
        }

        $category = Category::query();

        if ($name) {
            $category->where('name', 'like', '%'.$name.'%');
        }

        if ($show_product) {
            $category->with('products');
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'data category berhasil di ambil'
        );
    }
}
