<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body {
            font-family: dejavusans;
            font-size: 14px;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>

<h2>📄 {{ __('messages.invoice_title') }} #{{ $order->id }}</h2>

<p>
    {{ __('messages.client') }}:
    {{ $order->client->name ?? '---' }}
</p>

<p>
    {{ __('messages.date') }}:
    {{ $order->created_at->format('Y-m-d H:i') }}
</p>

<table>
    <thead>
        <tr>
            <th>{{ __('messages.product') }}</th>
            <th>{{ __('messages.quantity') }}</th>
            <th>{{ __('messages.price') }}</th>
            <th>{{ __('messages.total') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td>
                    {{ $item->product->{'title_' . app()->getLocale()} ?? $item->product->name }}
                </td>

                <td>{{ $item->quantity }}</td>

                <td>
                    {{ number_format($item->price, 2) }}
                </td>

                <td>
                    {{ number_format($item->quantity * $item->price, 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<h3 style="margin-top: 20px;">
    💰 {{ __('messages.total_amount') }}:
    {{ number_format($order->total_price, 2) }}
    {{ __('messages.currency') }}
</h3>

</body>
</html>