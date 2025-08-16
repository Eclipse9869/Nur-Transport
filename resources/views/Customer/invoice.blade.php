<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice Nur Trans Transport</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f8f8;
    }

    .invoice-header {
      border-bottom: 2px solid #f35525;
    }

    .orange-accent {
      color: #f35525;
    }

    .orange-bg {
      background-color: #f35525;
    }

    .invoice-table th {
      background-color: #f9f9f9;
      color: #333;
    }

    .invoice-table tr:nth-child(even) {
      background-color: #f8f8f8;
    }

    .watermark {
      position: absolute;
      opacity: 0.05;
      font-size: 80px;
      color: #f35525;
      transform: rotate(-30deg);
      z-index: -1;
      top: 35%;
      left: 20%;
      user-select: none;
    }
  </style>
</head>
<body class="bg-white p-2 text-sm">
  <div class="max-w-2xl mx-auto bg-white shadow-md p-2 relative" id="invoice">
    <div class="watermark">PAID</div>

    <!-- Invoice Header -->
    <div class="invoice-header pb-2 mb-3">
      <div class="flex justify-between items-start">
        <div>
          <h1 class="text-2xl font-bold orange-accent">{{ __('message.Tour Transport Invoice') }}</h1>
          <p class="text-gray-500">{{ __('message.Thank you for your booking') }}</p>
        </div>
        <div class="text-right">
          <h2 class="text-xl font-semibold">{{ __('message.INVOICE') }}</h2>
          <p class="text-gray-600">{{ __('message.No:') }} <span id="invoice-number" class="font-medium">INV-NRT-{{ $transaction->id }}</span></p>
          <p class="text-gray-600">{{ __('message.Date:') }} <span id="invoice-date" class="font-medium">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F Y') }}</span></p>
          <p class="text-gray-600">{{ __('message.Start Time:') }} <span class="font-medium">{{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}</span></p>
        </div>
      </div>

      <div class="flex justify-between mt-3 gap-2">
        <div class="bg-gray-100 p-2 rounded-md w-1/2">
          <h3 class="font-semibold mb-1 orange-accent">{{ __('message.Tour Provider') }}</h3>
          <p>Nur Trans</p>
          <p>Jl. Wisma Nusa Permai No.C7, Nusa Dua, Bali 80363.</p>
          <p>{{ __('message.Phone Number') }}: +6281-1396-2226</p>
          <p>{{ __('message.Email') }}: transport@nurtransbali.com</p>
        </div>

        <div class="bg-gray-100 p-2 rounded-md w-1/2">
          <h3 class="font-semibold mb-1 orange-accent">{{ __('message.Customer Details') }}</h3>
          <p id="customer-name">{{ $transaction->transactionDetails->first()->name }}</p>
          <p id="customer-phone">{{ $transaction->transactionDetails->first()->phone }}</p>
          <p id="customer-email">{{ auth()->user()->email }}</p>
        </div>
      </div>
    </div>

    <!-- Booking Details -->
    <div class="mb-3">
      <h3 class="text-base font-semibold mb-2 orange-accent">{{ __('message.Booking Information') }}</h3>
      <div class="bg-gray-100 p-2 rounded-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
          <div>
            <p class="font-medium">{{ __('message.Booking Reference:') }}</p>
            <p>NRT-{{ $transaction->id }}</p>
          </div>
          <div>
            <p class="font-medium">{{ __('message.Tour Date:') }}</p>
            <p>{{ \Carbon\Carbon::parse($transaction->start_date)->format('d F Y') }}</p>
          </div>
        </div>
        <div class="mt-2">
          <p class="font-medium">{{ __('message.Pickup Information:') }}</p>
          <p>{{ $transaction->transactionDetails->first()->carTour->location->name }} {{ __('message.at') }} {{ \Carbon\Carbon::parse($transaction->start_time)->format('H:i') }}</p>
        </div>
      </div>
    </div>

    <!-- Items Table -->
    <div class="mb-3">
      <h3 class="text-base font-semibold mb-2 orange-accent">{{ __('message.Invoice Items') }}</h3>
      <table class="w-full invoice-table text-sm">
        <thead>
          <tr class="text-left border-b">
            <th class="py-2 px-2">{{ __('message.Description') }}</th>
            <th class="py-2 px-2 text-right">{{ __('message.Amount') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b">
            <td class="py-2 px-2">{{ $transaction->transactionDetails->first()->carTour->car->name }} ({{ $transaction->qty }} {{ __('message.PAX') }})</td>
            <td class="py-2 px-2 text-right">{{ number_format($transaction->transactionDetails->first()->carTour->car->price, 0, ',', '.') }}</td>
          </tr>
          <tr class="border-b">
            <td class="py-2 px-2">{{ $transaction->transactionDetails->first()->carTour->type->name }}</td>
            <td class="py-2 px-2 text-right">{{ number_format($transaction->transactionDetails->first()->carTour->type->price, 0, ',', '.') }}</td>
          </tr>
          <tr class="border-b">
            <td class="py-2 px-2">{{ $transaction->transactionDetails->first()->carTour->location->name }}</td>
            <td class="py-2 px-2 text-right">{{ number_format($transaction->transactionDetails->first()->carTour->location->price, 0, ',', '.') }}</td>
          </tr>
          <tr class="border-b">
            <td class="py-2 px-2">{{ __('message.Private Driver') }}</td>
            <td class="py-2 px-2 text-right">0</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Totals -->
    <div class="flex justify-end">
      <div class="w-full">
        <div class="bg-gray-100 p-2 rounded-md">
          <div class="flex justify-between font-bold orange-accent">
            <span>{{ __('message.Total Amount:') }}</span>
            <span>{{ number_format($transaction->total, 0, ',', '.') }}</span>
          </div>
        </div>

        <div class="mt-3 bg-orange-50 border border-orange-100 rounded-md p-3">
          <h4 class="font-semibold mb-2 orange-accent">{{ __('message.Booking Notes & Information') }}</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
            <div>
              <p class="mb-1">• {{ __('message.Please arrive 15 minutes before scheduled pickup time') }}</p>
              <p class="mb-1">• {{ __('message.Bring valid ID and confirmation documents') }}</p>
            </div>
            <div>
              <p class="mb-1">• {{ __('message.Contact us for any itinerary changes') }}</p>
              <p class="mb-1">• {{ __('message.Present this invoice for verification') }}</p>
            </div>
          </div>
          <div class="mt-2 pt-2 border-t border-orange-200">
            <p class="font-medium">{{ __('message.Status:') }} <span class="font-bold text-green-600">{{ __('message.Confirmed & Paid') }}</span></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="mt-6 pt-3 border-t text-center text-xs text-gray-500">
      <p>{{ __('message.Invoice was created on computer and is valid without signature') }}</p>
      <p class="mt-1">{{ __('message.Thank you for choosing Nur Trans!') }}</p>
      <img src="{{ asset('image/logo.png') }}" alt="Nur Trans company logo" class="mx-auto mt-2 h-10 opacity-75" />
    </div>
  </div>

  <!-- Download Button -->
  <div class="max-w-2xl mx-auto mt-4 text-center space-x-4">
    <a href="{{ route('customer.myTransactions') }}">
      <button type="button" class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-md shadow-md hover:bg-gray-400 hover:text-black transition duration-200">
        {{ __('message.Back') }}
      </button>
    </a>
    <button onclick="generatePDF()" class="bg-[#f35525] text-white font-medium px-4 py-2 rounded-md shadow-md hover:bg-[#ff6d3d] transition duration-200">
      {{ __('message.Download Invoice as PDF') }}
    </button>
  </div>

  <script>
    // Set current date for invoice
    document.getElementById('invoice-date').textContent = new Date().toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    function generatePDF() {
      const element = document.getElementById('invoice');
      const { jsPDF } = window.jspdf;

      html2canvas(element, {
        scale: 1.2,
        logging: false,
        useCORS: true
      }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF({
          orientation: 'portrait',
          unit: 'mm',
          format: 'a4'
        });

        const pageWidth = pdf.internal.pageSize.getWidth();
        const imgProps = {
          width: canvas.width,
          height: canvas.height
        };
        const imgHeight = pageWidth * imgProps.height / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pageWidth, imgHeight);

        const invoiceNumber = document.getElementById('invoice-number').innerText.trim();
        pdf.save(`${invoiceNumber}.pdf`);
      });
    }
  </script>
</body>
</html>
