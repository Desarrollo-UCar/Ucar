@extends('plantilla')
@section('seccion')
<div class="jumbotron text-center">
    <h1 class="display-4">! Paso Final ¡</h1>
    <hr class="my-4">
    <p class="lead">Estás a punto de pagar con PayPal la cantidad de: 
        <h4>${{number_format($monto,2)}}</h4>
        <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
    </p>
    </p>La clave de reservacion se proporcionará una vez se procese el pago <br>
    <strong>(Dudas y aclaraciones: desarolloucar@gmail.com)</strong>
    </p>
</div>
@endsection
<script src="https://www.paypal.com/sdk/js?client-id=AcQMvZvnEKXeg1F6Tr0YWrUUXSsKYArdvnwLK8HHl2xgeEPHqT6Qjm4nmC8B5oNoBABUDgc4hMuHCNPO&currency=MXN"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{$monto}}'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaccion completaaaasseeess ' + details.payer.name.given_name + '!');
                        // Call your server to save the transaction
                        
                            var parametros = {
                                "orderID": data.orderID
                            };
                            $.ajax({      
                                    method:"POST",
                                    url:"{{route('despues_de_pago')}}",
                                    data:data.orderID,
                                    dataType:'JSON',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function( data ) {
                                        alert(data);
                                        },
                                    error: function(xhr, status, error) {
                                        alert(error); // check status && error
                                        },
                            });
                            
                });
            }


        }).render('#paypal-button-container');
    </script>