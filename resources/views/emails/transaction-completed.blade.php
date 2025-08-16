<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('message.Transaction Completed') }}</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #f35525;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .transaction-summary {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #f35525;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .detail-label {
            font-weight: bold;
            color: #555555;
        }
        .detail-value {
            color: #333333;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .product-table th {
            text-align: left;
            padding: 10px;
            background-color: #f2f2f2;
        }
        .product-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .total-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-top: 20px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 16px;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #f35525;
        }
        .footer {
            background-color: #333333;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>{{ __('message.Transaction Successful!') }}</h1>
        <p>{{ __('message.Thank you for choosing Nur Trans!') }}</p>
    </div>

    <!-- Main Content -->
    <div class="content">
        <p>{{ __('message.Hello') }} {{ $transaction->user->name ?? 'Customer' }},</p>
        <p>{{ __('message.Your booking has been successfully processed. Here are your transaction details: ') }}</p>

        <!-- Transaction Summary -->
        <div class="transaction-summary">
            <div class="detail-row">
                <span class="detail-label">{{ __('message.Invoice Number: ') }}</span>
                <span class="detail-value">{{ $transaction->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">{{ __('message.Transaction Date: ') }}</span>
                <span class="detail-value">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">{{ __('message.Payment Status: ') }}</span>
                <span class="detail-value" style="color: #28a745;">
                    <strong>{{ ucfirst($transaction->status) }}</strong>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label">{{ __('message.Start Date: ') }}</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($transaction->start_date)->format('d M Y') }}</span>
            </div>
        </div>

        <!-- Order Details -->
        <h3>{{ __('message.Order Details') }}</h3>
        <table class="product-table">
            <thead>
            <tr>
                <th>Car</th>
                <th>{{ __('message.Tour Type') }}</th>
                <th>{{ __('message.Location') }}</th>
                <th>{{ __('message.PAX') }}</th>
                <th>{{ __('message.Price(1 Pax)') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaction->transactionDetails as $detail)
                <tr>
                    <td>{{ $detail->carTour->car->name ?? '-' }}</td>
                    <td>{{ $detail->carTour->type->name ?? '-' }}</td>
                    <td>{{ $detail->carTour->location->name ?? '-' }}</td>
                    <td>{{ $transaction->qty }}</td>
                    <td>Rp {{ number_format($detail->total, 0, ',', '.') }}/Pax</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Payment Summary -->
        <div class="total-section">
            <div class="total-row grand-total">
                <span>{{ __('message.Total Amount') }}: </span>
                <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <p style="margin-top: 30px;">{{ __('message.If you have any questions, feel free to reply to this email or contact our support team.') }}</p>
        <p>{{ __('message.Warm regards') }},<br><strong>Nur Trans</strong></p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Nur Trans. All rights reserved.</p>
        <p style="margin-top: 10px;">
            <a href="https://nurtransbali.com" style="color: #ffffff;">Website</a> |
            <a href="#" style="color: #ffffff;">Privacy Policy</a> |
            <a href="#" style="color: #ffffff;">Terms & Conditions</a>
        </p>
    </div>
</div>
</body>
</html>
