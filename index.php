<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/markdown-it/8.0.0/markdown-it.min.js"></script>
  <meta charset="utf-8">
  <title>Developer Test</title>
  <style type="text/css">
  </style>
</head>
<body>
<div class="container">
<div class="row">
<div class="col">
  <section id="information"></section>
  <section id="code">
    <?php
      $prices = [];
      
      if ((include_once 'class-product-price.php') == FALSE) {
        echo( 'Could not include the product price class' );
      }
      else {
        $prices[] = new ProductPrice( 200, 'EUR', 'SKU-11334' );
        $prices[] = new ProductPrice( 250, 'USD', 'SKU-11334' );
        $prices[] = new ProductPrice( 252, 'USD', 'SKU-11335' );
        $prices[] = new ProductPrice( 550, 'USD', 'SKU-11336' );
        $prices[] = new ProductPrice( 530, 'USD', 'SKU-11337' );
        $prices[] = new ProductPrice( 133, 'USD', 'SKU-11338' );
        $prices[] = new ProductPrice( 441, 'USD', 'SKU-11339' );
        $prices[] = new ProductPrice( 867, 'USD', 'SKU-11341' );
      }
      $prices[3]->set_price( 252, 15 );

      $quantity = 55;
    ?>
    <table class="table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Currency</th>
          <th>VAT Percentage</th>
          <th>VAT</th>
          <th>Price excl VAT</th>
          <th>Price incl VAT</th>
          <th>Quantity</th>
          <th>Total VAT</th>
          <th>Total excl VAT</th>
          <th>Total incl VAT</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ( $prices as $price ): $quantity = 5 + ( $quantity * $quantity ) % 33; ?>
        <tr>
          <td><?= $price->name; ?></td>
          <td><?= $price->currency; ?></td>
          <td><?= $price->taxP; ?></td>
          <td><?= $price->taxA; ?></td>
          <td><?= $price->get_htm_price(1, 'get_price_excl_tax'); ?></td>
          <td><?= $price->get_htm_price(1, 'get_price_incl_tax'); ?></td>
          <td><?= $quantity; ?></td>
          <td><?= $price->taxA * $quantity; ?></td>
          <td><?= $price->get_htm_price($quantity, 'get_price_excl_tax'); ?></td>
          <td><?= $price->get_htm_price($quantity, 'get_price_incl_tax'); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </section>
<script type="text/javascript">
$.get( 'README.md', function( data ) {
  var markdown = markdownit();
  $('#information')
    .html( markdown.render( data ) )
    .find( 'h1' )
    .wrap( '<div class="page-header"></div>' )
    ;
} );
</script>
</div>
</div>
</dvi>
</body>
</htlm>
