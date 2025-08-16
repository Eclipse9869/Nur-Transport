<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Transaction Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 10px;
        }
        p {
            line-height: 1.6;
            font-size: 14px;
            color: #555;
        }
        .label {
            font-weight: bold;
            color: #222;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }
        .box {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #27ae60;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🛒 New Transaction Received</h2>

        <h3>👤 Customer Details</h3>
        <div class="box">
            <p><span class="label">Name:</span> {{ $transaction->user->name ?? '-' }}</p>
            <p><span class="label">Phone:</span> {{ $transaction->user->phone ?? '-' }}</p>
            <p><span class="label">email:</span> {{ $transaction->user->email ?? '-' }}</p>
        </div>

        <h3>📝 Transaction Details</h3>
        @foreach($transaction->transactionDetails as $detail)
            <div class="box">
                <p><span class="label">Booking Reference:</span> NRT-{{ $transaction->id }}</p>
                <p><span class="label">Car:</span> {{ $detail->carTour->car->name ?? '-' }} -  Rp {{ number_format($detail->carTour->car->price, 0, ',', '.') }}</p>
                <p><span class="label">Type:</span> {{ $detail->carTour->type->name ?? '-' }} - Rp {{ number_format($detail->carTour->type->price, 0, ',', '.') }}</p>
                <p><span class="label">Pax:</span> {{ $transaction->qty }}</p>
                <p><span class="label">Tour Date:</span> {{ \Carbon\Carbon::parse($transaction->start_date)->format('d M Y') }}</p>
                <p><span class="label">Pick Up Time:</span> {{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}</p>
                <p><span class="label">Pick Up Location:</span> {{ $detail->carTour->location->name ?? '-' }} - Rp {{ number_format($detail->carTour->location->price, 0, ',', '.') }}</p>
                <p><span class="label">Total Amount:</span> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            </div>
        @endforeach

        <div class="footer">
            This email was generated automatically when a new transaction was received.<br>
            &copy; {{ date('Y') }} Nur Trans. All rights reserved.
        </div>
    </div>
</body>
</html>
