<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            transition: box-shadow 150ms ease;
        }
    </style>
</head>
<body>
    
    <h2>Stripe Payment</h2>
    <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
        @csrf

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" placeholder="Enter your name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>

    <!-- Stripe Elements card input here -->
    {{-- <button type="submit">Submit Payment</button> --}}
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" placeholder="Enter amount" required>

        <label for="card-element">Credit or debit card:</label>
        <div id="card-element" class="StripeElement">
            <!-- Stripe Elements will insert the card input here -->
        </div>

        <div id="card-errors" role="alert"></div>

        <button type="submit">Submit Payment</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the token and form data to your server
        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
</body>
</html>
