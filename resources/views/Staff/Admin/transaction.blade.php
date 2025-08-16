@extends('layouts.admin')

@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center mb-4">
                    <div>
                        <h4 class="card-title">All Transactions</h4>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Transaction Date</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->user->name ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</td>
                                    <td>{{ $transaction->qty }} Pax</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $transaction->status === 'Paid' 
                                                ? 'success' 
                                                : ($transaction->status === 'Cancelled' 
                                                    ? 'danger' 
                                                    : 'warning') 
                                        }}">
                                            {{ $transaction->status }}
                                        </span>

                                        @if(strtolower(trim($transaction->status)) === 'pending payment')
                                            <div class="mt-1 text-muted small">
                                                ⏳ <span class="countdown"
                                                    data-expired="{{ \Carbon\Carbon::parse($transaction->expired_at)->toIso8601String() }}">
                                                    Loading...
                                                </span>
                                            </div>
                                            <form action="{{ route('transactions.cancel', ['id' => $transaction->id]) }}" method="POST" class="mt-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this transaction?')">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                    <td>
                                        @foreach ($transaction->transactionDetails as $detail)
                                            <div class="mb-3 p-2 border rounded bg-light">
                                                <strong>Nama:</strong> {{ $detail->name }}<br>
                                                <strong>Phone:</strong> {{ $detail->phone }}<br>
                                                <strong>Mobil:</strong> {{ $detail->carTour->car->name ?? '-' }}<br>
                                                <strong>Lokasi:</strong> {{ $detail->carTour->location->name ?? '-' }}<br>
                                                <strong>Tipe:</strong> {{ $detail->carTour->type->name ?? '-' }}<br>
                                                <strong>Start:</strong> 
                                                {{ \Carbon\Carbon::parse($detail->carTour->start_date)->format('d M Y') }},
                                                {{ \Carbon\Carbon::parse($detail->carTour->start_time)->format('H:i') }}<br>
                                                <strong>Subtotal:</strong> Rp {{ number_format($detail->total, 0, ',', '.') }}
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No transactions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const countdownElements = document.querySelectorAll('.countdown');
        let pageReloaded = false;

        countdownElements.forEach(el => {
            const expiredTime = new Date(el.getAttribute('data-expired')).getTime();

            function updateCountdownText() {
                const now = new Date().getTime();
                const distance = expiredTime - now;

                if (distance <= 0) {
                    el.textContent = "";
                    el.closest('.trx-expired-time')?.remove();
                    return;
                }

                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                el.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }

            updateCountdownText();
            setInterval(updateCountdownText, 1000);
        });

        const intervalChecker = setInterval(() => {
            if (pageReloaded) return;

            const now = new Date().getTime();
            for (const el of countdownElements) {
                const expiredTime = new Date(el.getAttribute('data-expired')).getTime();
                if (now >= expiredTime) {
                    pageReloaded = true;
                    clearInterval(intervalChecker);
                    location.reload();
                    break;
                }
            }
        }, 5000);
    });
</script>
@endsection