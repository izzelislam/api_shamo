<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with('transactionDetail.product')->find($id);

            if ($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'data transaksi berhasil di ambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'data transaksi gagal di ambil',
                    '404'
                );
            }
        }
        
        $transaction = Transaction::with('transactionDetail.product')->where('users_id', Auth::user()->id);

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'data berhasil di ambil'
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items'          => 'required|array',
            'items.*'        => 'exists:products,id',
            'total_price'    => 'required',
            'shipping_price' => 'required',
            'status'         => 'required|in:PENDING, SUCCESS, CANCELED, FAILED, SHIPPING, SHIPPED'
        ]);

        $transaction = Transaction::create([
            'users_id'         => Auth::user()->id,
            'address'          => $request->address,
            'total_price'      => $request->total_price,
            'shipping_price'   => $request->totalprice,
            'status'           => $request->status
        ]);

        foreach ($request->items as $item) {
            TransactionDetail::create([
                'users_id'          => Auth::user()->id,
                'transaction_id'    => $transaction->id,
                'products_id'       => $item['id'],
                'quantity'          => $item['quantity']
            ]);
        }

        return ResponseFormatter::success(
            $transaction->load('transactionDetail.product'),
            'transaksi berhasil'
        ); 
    }
}
