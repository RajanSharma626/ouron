<!DOCTYPE html>
<html>

<head>
    <title>Order Update</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="color: #555;">Order Update</h2>
        <p>Hi {{ $order->first_name }},</p>
        <p>Your order #{{ $order->id }} is now <strong style="color: #28a745;">{{ $status }}</strong>.</p>
        <p>Thank you for shopping with Ouron Lifestyle & Co.</p>
        <p style="margin-top: 20px; font-size: 0.9em; color: #777;">If you have any questions, feel free to contact our support team.</p>
    </div>
</body>

</html>
