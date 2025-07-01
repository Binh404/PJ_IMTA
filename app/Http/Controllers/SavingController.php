<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use App\Models\Goal; // Thêm Goal model để liên kết với bảng goals
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavingController extends Controller
{
    // Hiển thị danh sách khoản tiết kiệm của người dùng
    public function index()
    {
        // Lọc theo user_id để chỉ lấy khoản tiết kiệm của người dùng hiện tại
        $savings = Saving::where('user_id', Auth::id())->get();
        return view('savings.index', compact('savings'));
    }

    // Hiển thị form thêm khoản tiết kiệm
    public function create()
    {
        // Lấy danh sách mục tiêu của người dùng
        $goals = Goal::where('user_id', Auth::id())->get();
        return view('savings.create', compact('goals'));
    }

    // Xử lý thêm khoản tiết kiệm
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'goal_id' => 'required|integer|exists:goals,id',  // Kiểm tra mục tiêu có tồn tại
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        // Gán user_id từ Auth::id()
        $savingData = $request->all();
        $savingData['user_id'] = Auth::id();  // Gán user_id từ auth

        // Lưu dữ liệu vào bảng savings
        Saving::create($savingData);

        return redirect()->route('savings.index')->with('success', 'Khoản tiết kiệm đã được thêm!');
    }


    // Hiển thị form chỉnh sửa khoản tiết kiệm
    public function edit($id)
    {
        // Lấy khoản tiết kiệm của người dùng hiện tại
        $saving = Saving::where('user_id', Auth::id())->findOrFail($id);  // Chỉ cho phép sửa khoản tiết kiệm của chính người dùng

        // Lấy danh sách mục tiêu của người dùng
        $goals = Goal::where('user_id', Auth::id())->get();

        return view('savings.edit', compact('saving', 'goals'));
    }

    // Xử lý cập nhật khoản tiết kiệm
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'goal_id' => 'required|integer|exists:goals,id',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        // Cập nhật thông tin khoản tiết kiệm
        $saving = Saving::where('user_id', Auth::id())->findOrFail($id);  // Chỉ cho phép người dùng sửa khoản tiết kiệm của chính mình
        $saving->update([
            'goal_id' => $request->goal_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        return redirect()->route('savings.index')->with('success', 'Khoản tiết kiệm đã được cập nhật!');
    }

    // Xử lý xóa khoản tiết kiệm
    public function destroy($id)
    {
        // Xóa khoản tiết kiệm của người dùng
        $saving = Saving::where('user_id', Auth::id())->findOrFail($id);  // Chỉ cho phép người dùng xóa khoản tiết kiệm của chính mình
        $saving->delete();

        return redirect()->route('savings.index')->with('success', 'Khoản tiết kiệm đã được xóa!');
    }
}
