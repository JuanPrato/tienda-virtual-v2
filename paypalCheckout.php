<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>

  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'demo_sandbox_client_id',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'medium',
      color: 'black',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

 // Set up a payment
payment: function(data, actions) {
  return actions.payment.create({
    transactions: [{
      amount: {
        total: <?php echo $total ?>,
        currency: 'USD',
        details: {
          subtotal: <?php echo $total ?>
        }
      },
      description: 'Esta por comprar en cosas random.',
      custom: '90048630024435',
      //invoice_number: '12345', Insert a unique invoice number
      payment_options: {
        allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
      },
      soft_descriptor: 'ECHI5786786',
      item_list: {
        items: [
        <?php $i = 0; ?>
        <?php foreach ($carrito as $producto){ ?> 
            <?php if(!empty($producto['nombre'])){ ?>
                {
                    name: '<?php echo $producto['nombre'] ?>',
                    quantity: <?php echo $producto['cantidad'] ?>,
                    price: <?php echo $producto['precio'] ?>,
                    currency: 'USD'
                }
        <?php } ?>
        <?php if( $i !== (count($carrito)-2)){
            ?>,<?php
        } ?>
        <?php $i++; ?>
        <?php } ?>
        ]
      }
    }],
    note_to_payer: 'Contact us for any questions on your order.'
  });
},
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
        window.location.replace("includes/funciones/limpiar_carrito.php");
      });
    }
  }, '#paypal-button');

</script>