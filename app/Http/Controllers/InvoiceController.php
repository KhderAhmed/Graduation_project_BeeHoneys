<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LangServices;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    public function __construct(protected LangServices $langServices) {}

        public function download($orderId)
    {
        $order = Order::with('items.product', 'client')->findOrFail($orderId);

        $html = view('invoice', compact('order'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'DejaVuSans',  // خط عربي جيد
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            

        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('فاتورة_طلب_' . $order->id . '.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="فاتورة_طلب_' . $order->id . '.pdf"');
    }


    public function oldOrder()
    {
        $this->langServices->langFunction();
        $user = Auth::guard('client')->user();
        $orders = Order::with('items.product')
            ->where('client_id', $user->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }
public function orderSend($orderId)
{
    $order = Order::with('items.product', 'client')->findOrFail($orderId);

    try {

        \Log::info('ORDER MAIL START', [
            'order_id' => $order->id,
            'email' => $order->client->email,
        ]);

        Mail::to($order->client->email)
            ->send(new InvoiceMail($order));

        \Log::info('ORDER MAIL SENT', [
            'order_id' => $order->id,
            'email' => $order->client->email,
        ]);

        return back()->with(
            'message',
            '📩 تم إرسال الفاتورة إلى بريدك الإلكتروني.'
        );

    } catch (\Throwable $e) {

        \Log::error('ORDER MAIL FAILED', [
            'order_id' => $order->id,
            'email' => $order->client->email,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        return back()->with(
            'error',
            '❌ فشل إرسال الفاتورة: ' . $e->getMessage()
        );
    }
}
}
