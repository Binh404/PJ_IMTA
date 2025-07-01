<?php



namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    // Hiển thị danh sách ngân sách
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get();  // Lọc theo người dùng
        return view('budgets.index', compact('budgets'));
    }

    // Hiển thị form thêm ngân sách
    public function create()
    {
        return view('budgets.create');
    }

    // Xử lý thêm ngân sách
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'period' => 'required|in:monthly,yearly',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'period' => $request->period,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Ngân sách đã được tạo!');
    }

    // Hiển thị form chỉnh sửa ngân sách
    public function edit($id)
    {
        $budget = Budget::findOrFail($id);
        return view('budgets.edit', compact('budget'));
    }

    // Xử lý cập nhật ngân sách
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'period' => 'required|in:monthly,yearly',
        ]);

        $budget = Budget::findOrFail($id);
        $budget->update([
            'amount' => $request->amount,
            'period' => $request->period,
        ]);

        return redirect()->route('budgets.index')->with('success', 'Ngân sách đã được cập nhật!');
    }

    // Xử lý xóa ngân sách
    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return redirect()->route('budgets.index')->with('success', 'Ngân sách đã được xóa!');
    }
}