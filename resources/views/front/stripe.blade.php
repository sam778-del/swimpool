<!DOCTYPE html>
<html>
   <head>
      <title>Stripe Payment</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('css/luno.style.min.css') }}">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <style type="text/css">
         .panel-title {
         display: inline;
         font-weight: bold;
         }
         .display-table {
         display: table;
         }
         .display-tr {
         display: table-row;
         }
         .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
         }

         .InputElement {
            height: 65px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <center><h1>Payment Details</h1></center>
         <br>
         <div class="row">
             <center>
                <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-body">
                        <form
                            role="form"
                            action="{{ url('make-payment/new') }}"
                            method="POST"
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Customer Name</label>
                                    <input class='form-control' name="name" size='8' type='text' required>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Customer Email</label>
                                    <input class='form-control' name="email" size='4' type='email' required>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Mobile Number</label>
                                    <input class='form-control' name="mobile_number" size='4' type='number' required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="card-element">Credit or debit card</label>
                                <div id="card-element" class="form-control" style='height: 2.4em; padding-top: .7em;'>
                                  <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <input type="hidden" name="accessory_id" value="{{ $data['accesory_id'] }}" />
                            <input type="hidden" name="numerodipersone" value="{{ $data['numerodipersone'] }}" />
                            <input type="hidden" name="price_type" value="{{ $data['price_type'] }}" />
                            <input type="hidden" name="final_amount" value="{{ $data['final_amount'] }}" />
                            <input type="hidden" name="map_id" value="{{ $data['map_id'] }}" />
                            <input type="hidden" name="from" value="{{ $data['from'] }}" />
                            <input type="hidden" name="to" value="{{ $data['to'] }}" />
                            <input type="hidden" name="final_amount" value="{{ $data['final_amount'] }}" />
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (&euro;{{ number_format($data['final_amount'], 2) }})</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
             </center>
         </div>
      </div>
   </body>
   <script src="https://js.stripe.com/v3/"></script>
   <script type="text/javascript">
      $(function() {
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: '#32325d',
            },
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // $("#card-errors").html(result.error.message);
                    //show_toastr('Error', result.error.message, 'error');
                    toastr.error("{{__('Error') }}", result.error.message, 'error');

                } else {
                    // Send the token to your server.
                    $('button[type="submit"]').attr('disabled', 'disabled');
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    });
   </script>
    <script src="{{ asset('/bundles/toastr.min.js') }}"></script>
    @if(Session::has('success'))
    <script>
        toastr.success("{{__('Success') }}", "{!! session('success') !!}", 'success');
    </script>
    @endif
    @if(Session::has('error'))
        <script>
            toastr.error("{{__('Error') }}", "{!! session('error') !!}", 'error');
        </script>
    @endif
</html>
