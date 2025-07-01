@extends('layouts.app')

@section('title', 'Danh sách khoản tiết kiệm')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-dark">Danh sách khoản tiết kiệm</h3>
        <a href="{{ route('savings.create') }}" class="btn btn-success">+ Thêm khoản tiết kiệm</a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Mục tiêu</th>
                <th>Số tiền</th>
                <th>Ghi chú</th>
                <th>Ngày</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savings as $saving)
                <tr>
                    <td>{{ $saving->goal->name }}</td>
                    <td>{{ number_format($saving->amount) }} VND</td>
                    <td>{{ $saving->note }}</td>
                    <td>{{ $saving->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('savings.edit', $saving->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Sửa</a>
                        <form action="{{ route('savings.destroy', $saving->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
