<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    // Hiển thị danh sách mục tiêu
    public function index()
    {
        // Chỉ lấy mục tiêu của người dùng hiện tại
        $goals = Goal::where('user_id', Auth::id())->get();
        return view('goals.index', compact('goals'));
    }

    // Hiển thị form tạo mục tiêu
    public function create()
    {
        return view('goals.create');
    }

    // Lưu mục tiêu mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:ongoing,completed,failed',
        ]);

        // Tạo mục tiêu mới với user_id
        Goal::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'current_amount' => $request->current_amount ?? 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('goals.index')->with('success', 'Mục tiêu đã được tạo!');
    }

    // Xóa mục tiêu
    public function destroy($id)
    {
        // Chỉ xóa mục tiêu của người dùng hiện tại
        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Mục tiêu đã được xóa!');
    }

    // Thêm tiền vào mục tiêu tiết kiệm
    public function addFund(Request $request, Goal $goal)
    {
        $request->validate([
            'goal_id' => 'required|integer|exists:goals,id',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Kiểm tra xem mục tiêu có thuộc về người dùng hiện tại không
            if ($goal->user_id !== Auth::id()) {
                return back()->with('error', 'Không có quyền thực hiện hành động này.');
            }

            // Cập nhật số tiền trong mục tiêu
            $goal->current_amount += $request->amount;
            $goal->status = ($goal->current_amount >= $goal->amount) ? 'completed' : 'ongoing';
            $goal->save();

            // Tạo bản ghi tiết kiệm với user_id
            Saving::create([
                'user_id' => Auth::id(),
                'goal_id' => $goal->id,
                'amount' => $request->amount,
                'note' => $request->note,
            ]);

            DB::commit();
            return redirect()->route('goals.index')->with('success', 'Đã nộp ' . number_format($request->amount) . ' VND vào mục tiêu thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi khi nộp tiền: ' . $e->getMessage());
        }
    }

    // Hiển thị form chỉnh sửa mục tiêu
    public function edit(Goal $goal)
    {
        // Chỉ cho phép chỉnh sửa mục tiêu của người dùng hiện tại
        if ($goal->user_id !== Auth::id()) {
            return redirect()->route('goals.index')->with('error', 'Không có quyền chỉnh sửa mục tiêu này.');
        }
        return view('goals.edit', compact('goal'));
    }

    // Cập nhật thông tin mục tiêu
    public function update(Request $request, Goal $goal)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'current_amount' => 'numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:ongoing,completed,failed',
        ]);

        // Chỉ cho phép cập nhật mục tiêu của người dùng hiện tại
        if ($goal->user_id !== Auth::id()) {
            return redirect()->route('goals.index')->with('error', 'Không có quyền cập nhật mục tiêu này.');
        }

        $goal->update($request->all());

        return redirect()->route('goals.index')->with('success', 'Mục tiêu đã được cập nhật!');
    }
}