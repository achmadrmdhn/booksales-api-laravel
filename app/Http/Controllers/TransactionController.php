<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // READ
    public function index()
    {
        $transactions = Transaction::with(['customer', 'book'])->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource data not found!',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get all resources',
            'data'    => $transactions
        ], 200);
    }

    // CREATE
    public function store(Request $request)
    {
        // 1) Validate
        $validator = Validator::make($request->all(), [
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2) Ambil user login (JWT)
        $user = auth('api')->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // 3) Ambil buku & cek stok
        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return response()->json(['message' => 'Stok barang tidak cukup!'], 400);
        }

        // 4) Hitung total & generate nomor order
        $totalAmount  = $book->price * $request->quantity;
        $orderNumber  = 'ORD-' . strtoupper(Str::random(8));

        // 5) Kurangi stok
        $book->decrement('stock', $request->quantity);

        // 6) Simpan transaksi
        $transaction = Transaction::create([
            'order_number' => $orderNumber,
            'customer_id'  => $user->id,
            'book_id'      => $book->id,
            'quantity'     => $request->quantity,
            'total_amount' => $totalAmount,
        ])->load(['customer', 'book']);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully!',
            'data'    => $transaction
        ], 201);
    }

    // SHOW
    public function show($id)
    {
        $user = auth('api')->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $transaction = Transaction::with(['customer','book'])
            ->where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $transaction
        ], 200);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $user = auth('api')->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $transaction = Transaction::where('id', $id)
            ->where('customer_id', $user->id)
            ->first();

        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found or unauthorized'], 404);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = Book::find($transaction->book_id);

        // Hitung selisih (delta) quantity baru vs lama
        $oldQty = $transaction->quantity;
        $newQty = (int) $request->quantity;
        $delta  = $newQty - $oldQty;

        // Jika butuh tambahan stok
        if ($delta > 0) {
            if ($book->stock < $delta) {
                return response()->json(['message' => 'Stok tambahan tidak cukup!'], 400);
            }
            $book->decrement('stock', $delta);
        }
        // Jika mengurangi quantity, kembalikan stok
        if ($delta < 0) {
            $book->increment('stock', abs($delta));
        }

        // Update transaction
        $transaction->update([
            'quantity'     => $newQty,
            'total_amount' => $book->price * $newQty,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated',
            'data'    => $transaction->load(['customer','book'])
        ], 200);
    }

    // DELETE
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (! $transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Kembalikan stok buku
        $book = Book::find($transaction->book_id);
        if ($book) {
            $book->increment('stock', $transaction->quantity);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}
