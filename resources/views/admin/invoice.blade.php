<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoiceNumber }}</title>
    <style>
        /* Reset and base styles optimized for PDF rendering */
        * {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
        }

        body {
            color: #333;
            font-size: 12px;
            /* line-height: 1.4; */
            margin: 20px
        }

        .invoice-container {
            width: 100%;
            background-color: #ffffff;
        }

        /* Table styles for layout */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.header-table,
        table.company-table,
        table.summary-table {
            margin-bottom: 20px;
        }

        /* Header styles */
        .invoice-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .logo-img {
            max-width: 150px;
            max-height: 80px;
        }

        /* Divider */
        .divider {
            height: 2px;
            background-color: #2d6a4f;
            width: 100%;
            margin: 15px 0;
        }

        /* Section titles */
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .company-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Items table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th {
            background-color: #2d6a4f;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }

        .items-table th:last-child {
            text-align: right;
        }

        .items-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
            background-color: #f5f5f5;
        }

        .items-table td:last-child {
            text-align: right;
        }

        /* Notes and totals */
        .notes-box {
            background-color: #f5f5f5;
            padding: 10px;
            min-height: 80px;
        }

        .summary-label {
            background-color: #2d6a4f;
            color: white;
            padding: 6px 10px;
            text-align: center;
            width: 120px;
        }

        .summary-value {
            background-color: #f5f5f5;
            padding: 6px 10px;
            text-align: right;
        }

        .total-row .summary-label {
            font-weight: bold;
        }

        /* Terms section */
        .terms-content {
            background-color: #f5f5f5;
            padding: 10px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <table class="header-table">
            <tr>
                <td width="50%" valign="top">
                    <div class="invoice-title">Date: <span
                            style="font-weight: normal">{{ $order->created_at->format('d-m-Y') }}</span></div>
                    <div class="invoice-title" style="margin-top: 10px;">Invoice No: <span
                            style="font-weight: normal">{{ $invoiceNumber }}</span></div>
                </td>
                <td width="50%" align="right" valign="top">
                    <img src="https://ouron.in/images/logo/logo.svg" alt="Company Logo" class="logo-img">
                </td>
            </tr>
        </table>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Company and Client Info -->
        <table class="company-table">
            <tr>
                <td width="50%" valign="top">
                    <div class="section-title">From</div>
                    <div class="company-name">OURON Lifestyle & Co.</div>
                    <div>
                        GSTIN: 24AAJFO4572G1Z6<br>
                        +91 87992 32708<br>
                        contact@ouron.com<br>
                        www.ouron.in
                    </div>
                </td>
                <td width="50%" valign="top" align="right">
                    <div class="section-title">Bill to</div>
                    <div class="company-name">{{ $order->first_name ?? (' ' . ' ' . $order->last_name ?? ' ') }}</div>
                    <div>
                        {{ $order->phone }}<br>
                        {{ $order->email }}<br>
                        {{ $order->address }} {{ $order->address2 ?? '' }}<br>
                        {{ $order->city }}, {{ $order->state }} - {{ $order->pin_code }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Invoice Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th width="50%">Description</th>
                    <th width="15%">QTY.</th>
                    <th width="15%">Unit Price</th>
                    <th width="20%">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ $item->price }}</td>
                        <td>₹{{ $item->price * $item->quantity }}</td>
                    </tr>
                    @php
                        $total += $item->price * $item->quantity;
                    @endphp
                @endforeach
            </tbody>
        </table>

        <!-- Invoice Summary -->
        <table class="summary-table">
            <tr>
                <td width="60%" valign="top">
                    <div class="section-title">NOTES</div>
                    <div class="notes-box"></div>
                </td>
                <td width="40%" valign="top">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr style="border: 1px solid #ffffff;">
                            <td class="summary-label">Sub Total</td>
                            <td class="summary-value">₹{{ $order->total - $order->tax }}</td>
                        </tr>
                        <tr style="border: 1px solid #ffffff;">
                            <td class="summary-label">Tax Rate</td>
                            <td class="summary-value">{{ $order->total - $order->tax < 1000 ? 5 : 12 }}%</td>
                        </tr>
                        <tr style="border: 1px solid #ffffff;">
                            <td class="summary-label">Total Tax</td>
                            <td class="summary-value">₹{{ $order->tax }}</td>
                        </tr>
                        <tr class="total-row">
                            <td class="summary-label">TOTAL</td>
                            <td class="summary-value">₹{{ $order->total }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Terms and Conditions (commented out as in original) -->
        <div class="terms-section">
            <div class="section-title">Terms & Conditions</div>
            <div class="terms-content">
                1. All prices are inclusive of taxes and shown in INR.<br>
                2. We accept UPI, cards, net banking, and wallets for payments.<br>
                3. For billing help, contact us at <a href="mailto:help@ouron.in">help@ouron.in</a> or <a
                    href="tel:+918799232708">+91 8799232708</a>.
            </div>
        </div>
    </div>
</body>

</html>
