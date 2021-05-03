@extends('layouts.master')

@section('extra-script')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('extra-meta')
    <meta name="csrf-token" content='{{ csrf_token() }}'>
@endsection

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 bg-light p-3 text-center shadow">
                <h4>Page de paiement</h4>
                <hr>
                <div>
                    <form action="{{ route("checkout.store") }}" method="POST" id="payment_form" class="my-4">
                        @csrf
                        <div id="card-element">
                        <!-- Elements will create input elements here -->
                        </div>
    
                        <!-- We'll put the error messages in this element -->
                        <div id="card-errors" role="alert"></div>
    
                        <button class="btn btn-success mt-3" id="submit">Pay ({{ getPrice(Cart::total()) }})</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<script>
    var stripe = Stripe('pk_test_51I5qyyHGmSftft1X25504uqJK8aD890qNNSoiRo7XNHEANr4B9xGtRbdvWVxUcvHYajc33Vgoi9wDbpxz3exP5hD002hFrFJM1');
    var elements = stripe.elements();
    var style = {
        base: {
        color: "#32325d",
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
            color: "#aab7c4"
        }
        },
        invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
        }
    };
    var card = elements.create("card", { style: style });
    card.mount("#card-element");
    card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
        if (error) {
            displayError.classList.add('alert', 'alert-warning', 'mt-3');
            displayError.textContent = error.message;
        } else {
            displayError.classList.remove('alert', 'alert-warning', 'mt-3');
            displayError.textContent = '';
        }
    });
    var submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButton.disable = true;
    stripe.confirmCardPayment("{{ $client_secret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
            submitButton.disable = false
            // Show error to your customer (e.g., insufficient funds)
            console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var token = document.querySelector("meta[name='csrf-token']").getAttribute("content")
                    var form = document.getElementById("payment_form");
                    var url = form.action;
                    var redirect = "/success";

                    // do request
                    fetch(
                        url,
                        { 
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token,
                            }, 
                            method: "POST",
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })
                        }
                    ).then((data) => {
                        console.log(data);
                        window.location.href = redirect
                    }).catch((error) =>{
                        console.log(error)
                    })
                }
            }
        });
    });
</script>
@endsection