<?php
namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Lấy danh sách khoản tiết kiệm và tên mục tiêu của người dùng hiện tại
        $savings = Saving::where('savings.user_id', Auth::id())  // Chỉ rõ bảng savings
            ->join('goals', 'goals.id', '=', 'savings.goal_id')  // Join bảng goals để lấy tên mục tiêu
            ->select('goals.name as goal_name', DB::raw('SUM(savings.amount) as total_amount'))  // Thêm 'savings.' trước amount để tránh mơ hồ
            ->groupBy('goals.name')  // Nhóm theo tên mục tiêu
            ->get();  // Lấy tất cả các kết quả

        // Truyền dữ liệu vào view
        return view('dashboard', compact('savings'));  // Đảm bảo đã truyền biến savings
    }






}
