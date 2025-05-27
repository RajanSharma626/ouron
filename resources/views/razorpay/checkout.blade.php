<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .payment-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .payment-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3399cc, #667eea);
        }

        #status-message {
            display: none;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            transition: all 0.3s ease;
        }

        .processing-icon {
            background: linear-gradient(45deg, #3399cc, #667eea);
            color: white;
            animation: pulse 2s infinite;
        }

        .success-icon {
            background: linear-gradient(45deg, #4CAF50, #45a049);
            color: white;
            animation: bounceIn 0.6s ease;
        }

        .error-icon {
            background: linear-gradient(45deg, #f44336, #d32f2f);
            color: white;
            animation: shake 0.6s ease;
        }

        .pending-icon {
            background: linear-gradient(45deg, #ff9800, #f57c00);
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #status-text {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .status-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .success #status-text {
            color: #4CAF50;
        }

        .error #status-text {
            color: #f44336;
        }

        .pending #status-text {
            color: #ff9800;
        }

        .processing #status-text {
            color: #3399cc;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #f0f0f0;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #3399cc, #667eea);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .processing .progress-fill {
            width: 60%;
            animation: progressPulse 2s infinite;
        }

        .success .progress-fill {
            width: 100%;
        }

        .error .progress-fill {
            width: 100%;
            background: linear-gradient(90deg, #f44336, #d32f2f);
        }

        .pending .progress-fill {
            width: 80%;
            background: linear-gradient(90deg, #ff9800, #f57c00);
        }

        @keyframes progressPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .action-buttons {
            margin-top: 30px;
            display: none;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #3399cc, #667eea);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(51, 153, 204, 0.3);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .payment-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            display: none;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .detail-label {
            color: #666;
        }

        .detail-value {
            font-weight: 600;
            color: #333;
        }

        .loading-container {
            display: block;
            text-align: center;
        }

        .loading-text {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3399cc;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @media (max-width: 480px) {
            .payment-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .status-icon {
                width: 60px;
                height: 60px;
                font-size: 30px;
            }

            #status-text {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <!-- Initial loading state -->
        <div id="loading-container" class="loading-container">
            <div class="loading-text">Initializing Payment...</div>
            <div class="loading-spinner"></div>
        </div>

        <!-- Status message container -->
        <div id="status-message">
            <div class="status-icon" id="status-icon">
                <div class="spinner" id="spinner"></div>
            </div>
            <h3 id="status-text">Processing your payment...</h3>
            <p class="status-description" id="status-description">Please wait while we process your payment securely.
            </p>

            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>

            <div class="payment-details" id="payment-details">
                <div class="detail-row">
                    <span class="detail-label">Payment ID:</span>
                    <span class="detail-value" id="payment-id">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order ID:</span>
                    <span class="detail-value" id="order-id">-</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Amount:</span>
                    <span class="detail-value" id="amount-display">-</span>
                </div>
            </div>

            <div class="action-buttons" id="action-buttons">
                <button class="btn btn-primary" onclick="retryPayment()">Try Again</button>
                <button class="btn btn-secondary" onclick="goBack()">Go Back</button>
            </div>
        </div>
    </div>

    <script>
        // Wait for DOM to be ready
        document.addEventListener('DOMContentLoaded', function() {
            initializePayment();
        });

        function safeGetElement(id) {
            const element = document.getElementById(id);
            if (!element) {
                console.warn(`Element with id '${id}' not found`);
            }
            return element;
        }

        function updateStatus(status, title, description, showDetails = false, showActions = false) {
            const container = safeGetElement('status-message');
            const icon = safeGetElement('status-icon');
            const spinner = safeGetElement('spinner');
            const statusText = safeGetElement('status-text');
            const statusDesc = safeGetElement('status-description');
            const details = safeGetElement('payment-details');
            const actions = safeGetElement('action-buttons');

            if (!container) return;

            // Hide loading container
            const loadingContainer = safeGetElement('loading-container');
            if (loadingContainer) {
                loadingContainer.style.display = 'none';
            }

            // Show status message
            container.style.display = 'block';

            // Remove all status classes
            container.className = '';
            container.classList.add(status);

            // Update content
            if (statusText) statusText.textContent = title;
            if (statusDesc) statusDesc.textContent = description;

            // Update icon
            if (icon) {
                if (spinner) spinner.style.display = 'none';
                icon.innerHTML = '';

                switch (status) {
                    case 'processing':
                        icon.innerHTML = '<div class="spinner"></div>';
                        icon.className = 'status-icon processing-icon';
                        break;
                    case 'success':
                        icon.innerHTML = '✓';
                        icon.className = 'status-icon success-icon';
                        break;
                    case 'error':
                        icon.innerHTML = '✕';
                        icon.className = 'status-icon error-icon';
                        break;
                    case 'pending':
                        icon.innerHTML = '⏳';
                        icon.className = 'status-icon pending-icon';
                        break;
                }
            }

            // Show/hide details and actions
            if (details) details.style.display = showDetails ? 'block' : 'none';
            if (actions) actions.style.display = showActions ? 'block' : 'none';
        }

        function retryPayment() {
            location.reload();
        }

        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                // Fallback if no history
                window.location.href = '/';
            }
        }

        function initializePayment() {
            // Replace these with your actual values or get them from your backend
            const razorpayConfig = {
                key: "{{ $razorpay_key ?? 'your_razorpay_key' }}",
                amount: "{{ $amount ?? '100000' }}", // Amount in paise
                currency: "INR",
                name: "{{ $name ?? 'Your Business Name' }}",
                description: "Order Payment",
                order_id: "{{ $order_id ?? 'order_id_here' }}",
                prefill: {
                    name: "{{ $name ?? 'Customer Name' }}",
                    email: "{{ $email ?? 'customer@example.com' }}",
                    contact: "{{ $phone ?? '9999999999' }}"
                },
                theme: {
                    color: "#3399cc"
                }
            };

            const options = {
                ...razorpayConfig,
                handler: function(response) {
                    // Hide loading, show status
                    const loadingContainer = safeGetElement('loading-container');
                    if (loadingContainer) {
                        loadingContainer.style.display = 'none';
                    }

                    const statusMessage = safeGetElement('status-message');
                    if (statusMessage) {
                        statusMessage.style.display = 'block';
                    }

                    // Update payment details
                    const paymentId = safeGetElement('payment-id');
                    const orderId = safeGetElement('order-id');
                    const amountDisplay = safeGetElement('amount-display');

                    if (paymentId) paymentId.textContent = response.razorpay_payment_id;
                    if (orderId) orderId.textContent = response.razorpay_order_id;
                    if (amountDisplay) {
                        const amount = parseInt(razorpayConfig.amount) / 100;
                        amountDisplay.textContent = '₹' + amount.toFixed(2);
                    }

                    updateStatus('processing', 'Processing Payment...', 'Please wait while we verify your payment.',
                        true);

                    // Send to backend for verification
                    fetch("/razorpay/callback", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                    'content') || "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature
                            })
                        })
                        .then(res => {
                            if (!res.ok) {
                                throw new Error(`HTTP error! status: ${res.status}`);
                            }
                            return res.json();
                        })
                        .then(data => {
                            if (data.status === 'success') {
                                updateStatus('success', 'Payment Successful!',
                                    'Your payment has been processed successfully. Redirecting you now...',
                                    true);
                                setTimeout(() => {
                                    if (data.redirect) {
                                        window.location.href = data.redirect;
                                    } else {
                                        // Fallback redirect
                                        window.location.href = '/payment-success';
                                    }
                                }, 2000);
                            } else if (data.status === 'pending') {
                                updateStatus('pending', 'Payment Pending',
                                    'Your payment is being processed. You will receive a confirmation shortly.',
                                    true);
                            } else {
                                updateStatus('error', 'Payment Failed',
                                    data.message ||
                                    'Unfortunately, your payment could not be processed. Please try again.',
                                    true, true);
                            }
                        })
                        .catch(error => {
                            console.error('Payment verification error:', error);
                            updateStatus('error', 'Something Went Wrong',
                                'An unexpected error occurred. Please try again or contact support.', false,
                                true);
                        });
                },
                modal: {
                    ondismiss: function() {
                        console.log('Payment modal closed by user');
                        // Show error state when user cancels
                        updateStatus('error', 'Payment Cancelled',
                            'You have cancelled the payment process.', false, true);
                    }
                }
            };

            try {
                const rzp = new Razorpay(options);

                // Hide loading after a short delay and open payment modal
                setTimeout(() => {
                    const loadingContainer = safeGetElement('loading-container');
                    if (loadingContainer) {
                        loadingContainer.style.display = 'none';
                    }
                    rzp.open();
                }, 1000);

            } catch (error) {
                console.error('Error initializing Razorpay:', error);
                updateStatus('error', 'Initialization Failed',
                    'Unable to initialize payment gateway. Please refresh and try again.', false, true);
            }
        }
    </script>
</body>

</html>
