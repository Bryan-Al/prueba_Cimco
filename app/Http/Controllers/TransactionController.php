<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['product', 'user', 'supplier'])->get();
        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('transactions.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entry,exit,adjustment',
            'quantity' => 'required|integer',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $transaction = new Transaction();
        $transaction->product_id = $request->product_id;
        $transaction->user_id = Auth::id();
        $transaction->type = $request->type;
        $transaction->quantity = $request->quantity;
        $transaction->supplier_id = $request->supplier_id;
        $transaction->transaction_date = now();
        $transaction->save();

        // Adjust product quantity based on transaction type
        $product = Product::find($request->product_id);
        if ($request->type == 'entry') {
            $product->quantity += $request->quantity;
        } elseif ($request->type == 'exit') {
            $product->quantity -= $request->quantity;
        } elseif ($request->type == 'adjustment') {
            $product->quantity = $request->quantity;
        }
        $product->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }
}
