<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // Hiển thị danh sách giao dịch
    public function index(Request $request)
{
    // Lấy tháng hiện tại hoặc từ yêu cầu
    $month = $request->input('month', now()->format('Y-m'));

    // Lấy tất cả các tháng có giao dịch của người dùng
    $months = Transaction::where('user_id', Auth::id())
        ->selectRaw("DATE_FORMAT(date, '%Y-%m') as month")
        ->distinct()
        ->pluck('month');

    // Lấy tất cả giao dịch theo user_id, sắp xếp theo ngày mới nhất
    $transactions = Transaction::where('user_id', Auth::id())
        ->whereMonth('date', now()->month)
        ->whereYear('date', now()->year)
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();
   // Lọc giao dịch theo tháng đã chọn
    $transactions = Transaction::where('user_id', Auth::id())
        ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$month])
        ->orderBy('date', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();
    // Tính toán tổng thu, tổng chi và số dư
    $totalIncome = $transactions->where('type', 'income')->sum('amount');
    $totalExpense = $transactions->where('type', 'expense')->sum('amount');
    $balance = $totalIncome - $totalExpense;

    return view('transactions.index', compact('transactions', 'month', 'totalIncome', 'totalExpense', 'balance', 'months'));
}

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // Lưu giao dịch với user_id
        Transaction::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Giao dịch đã được thêm!');
    }

    public function edit($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        $transaction->update([
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Giao dịch đã được cập nhật!');
    }

    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Giao dịch đã được xóa thành công!');
    }
}
