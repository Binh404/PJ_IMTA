@extends('layouts.app')

@section('title', 'Danh sách ngân sách')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark bg-gradient d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0 text-white">Danh sách ngân sách</h4>
            <a href="{{ route('budgets.create') }}" class="btn btn-light">
                <i class="fas fa-plus-circle me-1"></i> Thêm ngân sách
            </a>
        </div>
        <div class="card-body">
            @if(count($budgets) > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Tiền</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets as $budget)
                                <tr>
                                    <td>
                                        <span class="fw-bold text-success">{{ number_format($budget->amount) }} VND</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ ucfirst($budget->period) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit me-1"></i> Sửa
                                            </a>
                                            <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    <i class="fas fa-trash-alt me-1"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i> Chưa có ngân sách nào được tạo.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
