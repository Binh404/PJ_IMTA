@extends('layouts.app')

@section('title', 'Thêm Mục tiêu')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center">
                <h3 class="mb-0">Thêm Mục tiêu</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('goals.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control" id="name" name="name" required placeholder="Nhập tên mục tiêu">
                    </div>

                    <div class="form-group">
                        <label for="amount">Số tiền cần:</label>
                        <input type="number" class="form-control" id="amount" name="amount" required placeholder="Nhập số tiền cần thiết">
                    </div>

                    <div class="form-group">
                        <label for="current_amount">Số tiền hiện tại:</label>
                        <input type="number" class="form-control" id="current_amount" name="current_amount" value="0" placeholder="Nhập số tiền hiện tại">
                    </div>

                    <div class="form-group">
                        <label for="start_date">Ngày bắt đầu:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">Ngày kết thúc:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="ongoing">Đang thực hiện</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="failed">Thất bại</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Lưu</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                alert('Mục tiêu đã được thêm thành công!');
            });
        });
    </script>

    <style>
        .card {
            border-radius: 15px;
        }

        .btn-success {
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-success:hover {
            background-color: #28a745;
            transform: scale(1.05);
        }
    </style>
@endsection
