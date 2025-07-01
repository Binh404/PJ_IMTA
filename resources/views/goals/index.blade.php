@extends('layouts.app')

@section('title', 'Mục tiêu tiết kiệm')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark"><i class="fas fa-bullseye me-2"></i>Mục tiêu tiết kiệm</h3>
        <a href="{{ route('goals.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Thêm mục tiêu mới
        </a>
    </div>

    @if(count($goals) > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($goals as $goal)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 goal-card">
                <div class="card-header bg-transparent border-bottom-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-truncate mb-0" title="{{ $goal->name }}">{{ $goal->name }}</h5>
                        <span class="badge rounded-pill
                            @if($goal->status == 'completed') bg-success
                            @elseif($goal->status == 'in progress') bg-primary
                            @elseif($goal->status == 'planning') bg-warning
                            @else bg-secondary @endif">
                            {{ ucfirst($goal->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Tiến độ</span>
                            <span>{{ round(($goal->current_amount / $goal->amount) * 100) }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($goal->current_amount / $goal->amount) * 100 }}%;"
                                aria-valuenow="{{ ($goal->current_amount / $goal->amount) * 100 }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Đã tiết kiệm:</span>
                        <span class="fw-bold text-success">{{ number_format($goal->current_amount) }} VND</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Cần:</span>
                        <span class="fw-bold">{{ number_format($goal->amount) }} VND</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Còn lại:</span>
                        <span class="fw-bold text-danger">{{ number_format($goal->amount - $goal->current_amount) }} VND</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="small">
                            <i class="far fa-calendar-alt me-1"></i> Bắt đầu:
                            <span class="text-muted">{{ \Carbon\Carbon::parse($goal->start_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="small">
                            <i class="far fa-calendar-check me-1"></i> Kết thúc:
                            <span class="text-muted">{{ \Carbon\Carbon::parse($goal->end_date)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent d-flex justify-content-between gap-2">
                    <a href="{{ route('goals.edit', $goal->id) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                        <i class="fas fa-edit me-1"></i> Sửa
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-success flex-grow-1" data-bs-toggle="modal" data-bs-target="#addFundModal{{ $goal->id }}">
                        <i class="fas fa-plus-circle me-1"></i> Nộp tiền
                    </button>
                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" class="d-inline flex-grow-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Bạn có chắc chắn muốn xóa mục tiêu này?')">
                            <i class="fas fa-trash-alt me-1"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal thêm tiền -->
        <div class="modal fade" id="addFundModal{{ $goal->id }}" tabindex="-1" aria-labelledby="addFundModalLabel{{ $goal->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFundModalLabel{{ $goal->id }}">Thêm tiền vào mục tiêu: {{ $goal->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('goals.add-fund', $goal->id) }}" method="POST">
                        <input type="hidden" name="goal_id" value="{{ $goal->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Số tiền</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="amount" name="amount" required min="0">
                                    <span class="input-group-text">VND</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú (tùy chọn)</label>
                                <textarea class="form-control" id="note" name="note" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-success">Thêm tiền</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-bullseye text-muted" style="font-size: 4rem;"></i>
        </div>
        <h5 class="text-muted">Chưa có mục tiêu tiết kiệm nào</h5>
        <p class="text-muted">Hãy tạo mục tiêu tiết kiệm đầu tiên của bạn để bắt đầu quản lý tài chính tốt hơn. (chú ý tạo mục tiêu trước)</p>
        <a href="{{ route('goals.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus-circle me-2"></i>Tạo mục tiêu đầu tiên
        </a>
    </div>
    @endif
</div>
@endsection

@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .goal-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .goal-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .card-header {
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
