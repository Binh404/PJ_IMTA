{{-- @extends('layouts.app')

@section('title', 'Giao dịch')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark">Lịch sử giao dịch</h3>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">+ Thêm giao dịch</a>
    </div>

    <!-- Thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Timeline giao dịch -->

</div>

<!-- Thêm Bootstrap và Icons -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> --}}



@extends('layouts.app')

@section('title', 'Lịch sử giao dịch')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark">Lịch sử giao dịch</h3>
        <a href="{{ route('transactions.create') }}" class="btn btn-success">+ Thêm giao dịch</a>
    </div>

    <!-- Chọn tháng -->
    <form method="GET" action="{{ route('transactions.index') }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="month" class="form-label">Chọn tháng:</label>
            </div>
            <div class="col-auto">
                <select name="month" id="month" class="form-select">
                    @foreach($months as $m)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ Carbon\Carbon::parse($m)->format('m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>

    <!-- Báo cáo tài chính -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Thu nhập</h5>
                    <h3>{{ number_format($totalIncome) }} VND</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Chi tiêu</h5>
                    <h3>{{ number_format($totalExpense) }} VND</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Số dư</h5>
                    <h3>{{ number_format($balance) }} VND</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline giao dịch -->
    <div class="timeline">
        @foreach($transactions as $transaction)
            <div class="timeline-item
                {{ $transaction->type == 'income' ? 'border-success' : 'border-danger' }}">
                <div class="timeline-icon
                    {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                    @if($transaction->type == 'income')
                        <i class="bi bi-arrow-up-circle"></i>
                    @else
                        <i class="bi bi-arrow-down-circle"></i>
                    @endif
                </div>
                <div class="timeline-content">
                    <h5>
                        <!-- Hiển thị số tiền với dấu + hoặc - dựa vào loại giao dịch -->
                        {{ $transaction->type == 'income' ? '+' : '-' }}
                        {{ number_format($transaction->amount) }} VND
                        -
                        <!-- Hiển thị loại giao dịch với màu nền -->
                        <span class="badge
                            {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </h5>
                    <p>{{ $transaction->note }}</p>
                    <small>{{ $transaction->date }}</small>
                    <div class="mt-2">
                        <!-- Nút sửa -->
                        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Sửa</a>

                        <!-- Nút xóa với xác nhận -->
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa giao dịch này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>

                <!-- CSS tùy chỉnh để làm đẹp badge -->
                <style>
                    .bg-success {
                        background-color: #28a745 !important;
                        color: white;
                        padding: 3px 8px;
                        border-radius: 5px;
                    }

                    .bg-danger {
                        background-color: #dc3545 !important;
                        color: white;
                        padding: 3px 8px;
                        border-radius: 5px;
                    }

                    .timeline-content h5 {
                        font-weight: bold;
                    }
                </style>


            </div>
        @endforeach
    </div>
</div>
@endsection
<!-- CSS cho Timeline -->
 <style>
    .timeline {
        position: relative;
        padding: 20px 0;
        list-style: none;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 50px;
        border-left: 3px solid #ddd;
    }
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    .timeline-icon {
        position: absolute;
        left: -20px;
        top: 0;
        background: #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        color: #fff;
    }
    .timeline-content {
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .timeline-content h5 {
        margin: 0;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
