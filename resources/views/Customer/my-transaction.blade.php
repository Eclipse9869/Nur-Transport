@extends('layouts.user')
@section('content')
<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="{{ route('customer.index') }}">{{ __('message.Home') }}</a> / {{ __('message.My Transactions') }}</span>
          <h3>{{ __('message.My Transactions') }}</h3>
        </div>
      </div>
    </div>
</div>

<div class="section properties">
    <div class="trx-container">
        <div class="trx-filter">
            <ul class="properties-filter">
                <li>
                    <a href="#" class="is_active" data-filter="*">All</a>
                </li>
                <li>
                    <a href="#" data-filter=".status-pending">Pending Payment</a>
                </li>
                <li>
                    <a href="#" data-filter=".status-paid">Paid</a>
                </li>
                <li>
                    <a href="#" data-filter=".status-cancelled">Cancelled</a>
                </li>
            </ul>
        </div>

        @forelse ($transactions as $transaction)
            @php
                $statusClass = match($transaction->status) {
                    'Pending Payment' => 'status-pending',
                    'Paid' => 'status-paid',
                    'Cancelled' => 'status-cancelled',
                    default => '',
                };
            @endphp

            <div class="trx-card {{ $statusClass }}">
                <div class="trx-header">
                    <span class="trx-id">NRT-{{ $transaction->id }}</span>
                    @if($transaction->status === 'Pending Payment')
                        <span class="trx-expired-time">
                            ⏳ <span class="countdown"
                                data-expired="{{ \Carbon\Carbon::parse($transaction->expired_at)->toIso8601String() }}">
                                {{ __('message.Loading') }}...
                            </span>
                        </span>
                    @endif
                    <span class="trx-status
                        {{ $transaction->status === 'Paid' ? 'completed' : 
                            ($transaction->status === 'Pending Payment' ? 'pending' : 
                            ($transaction->status === 'Cancelled' ? 'cancelled' : '')) }}">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>

                <div class="trx-details">
                    <img src="{{ asset('storage/' . $transaction->transactionDetails->first()->carTour->car->image) }}" class="trx-image">
                    <div class="trx-info">
                        <div class="trx-car-model">{{ $transaction->transactionDetails->first()->carTour->car->name }}</div>
                        <div class="trx-car-type">{{ $transaction->transactionDetails->first()->carTour->car->carType->name }}</div>
                        <div class="trx-date-info">
                            <div>
                                <span class="trx-label">{{ __('message.Tour Type') }}:</span>
                                <span class="trx-value">{{ $transaction->transactionDetails->first()->carTour->type->name }} Tour</span>
                            </div>
                            <div>
                                <span class="trx-label">{{ __('message.Pick Up Location') }}:</span>
                                <span class="trx-value">{{ $transaction->transactionDetails->first()->carTour->location->name }}</span>
                            </div>
                            <div><span class="trx-label">{{ __('message.Person') }}:</span><span class="trx-value">{{ $transaction->qty }} {{ __('message.PAX') }}</span></div>
                            <div><span class="trx-label">{{ __('message.Tour Date') }}:</span><span class="trx-value">{{ \Carbon\Carbon::parse($transaction->start_date)->format('d M Y') }}</span></div>
                            <div><span class="trx-label">{{ __('message.Pick Up Time') }}:</span><span class="trx-value">{{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}</span></div>
                        </div>
                    </div>
                </div>

                <div class="trx-summary">
                    <div>
                        <span class="trx-label">{{ __('message.Total Amount') }}:</span>
                        <span class="trx-total">Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="trx-actions">
                        @if ($transaction->status === 'Paid')
                            <a href="{{ route('customer.invoice', $transaction->id) }}" target="_blank" class="trx-btn invoice">
                                {{ __('message.Invoice') }}
                            </a>
                        @elseif ($transaction->status === 'Pending Payment')
                            <a href="{{ route('customer.order', $transaction->id) }}" class="trx-btn continue">{{ __('message.Continue Payment') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">{{ __("message.You don't have any transactions yet.") }}</p>
        @endforelse
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

        // const intervalChecker = setInterval(() => {
        //     if (pageReloaded) return;
        //     const now = new Date().getTime();
        //     for (const el of countdownElements) {
        //         const expiredTime = new Date(el.getAttribute('data-expired')).getTime();
        //         if (now >= expiredTime) {
        //             pageReloaded = true;
        //             clearInterval(intervalChecker);
        //             location.reload();
        //             break;
        //         }
        //     }
        // }, 5000);

        // ==== FILTERING ====
        const filterLinks = document.querySelectorAll('.properties-filter a');
        const trxCards = document.querySelectorAll('.trx-card');

        filterLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const filter = link.getAttribute('data-filter');

                filterLinks.forEach(l => l.classList.remove('is_active'));
                link.classList.add('is_active');

                trxCards.forEach(card => {
                    if (filter === '*' || card.classList.contains(filter.replace('.', ''))) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
