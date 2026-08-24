<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mpdf\Mpdf;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        \Log::info('InvoiceMail: BUILD START', [
            'order_id' => $this->order->id,
        ]);

        $html = view('invoice', [
            'order' => $this->order
        ])->render();

        \Log::info('InvoiceMail: HTML CREATED');

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
        ]);

        $mpdf->WriteHTML($html);

        \Log::info('InvoiceMail: HTML WRITTEN TO PDF');

        $pdfContent = $mpdf->Output('', 'S');

        \Log::info('InvoiceMail: PDF CREATED', [
            'size' => strlen($pdfContent),
        ]);

        return $this
            ->subject('فاتورة طلب #' . $this->order->id)
            ->view('emails.invoice-notice')
            ->attachData(
                $pdfContent,
                'invoice_' . $this->order->id . '.pdf',
                [
                    'mime' => 'application/pdf',
                ]
            );
    }
}