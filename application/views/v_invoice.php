<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }
    
    h1 {
      text-align: center;
    }
    
    .invoice-details {
      margin-bottom: 20px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    th, td {
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      text-align: left;
    }
    
    .total {
      font-weight: bold;
    }
    
    .footer {
      text-align: center;
    }

    #cancelbox {
          border: 1px solid black;
          padding: 0px 20px;
          display: inline-block;
          float: right;
    }
  </style>
</head>
<body>
  <h1>Order Invoice</h1>

  <?php if($trans['trans']->is_cancelled == 1) { ?>
    <div id="cancelbox">
      <h2>Order is Cancelled</h2>
    </div>
  <?php } ?>

  <div class="invoice-details">
    <p><strong>Order Number:</strong> <?php echo $trans['trans']->id; ?></p>
    <p><strong>Order Date:</strong> <?php echo strftime("%d %B %Y %H:%I:%S", strtotime($trans['trans']->order_placed_date)); ?></p>
    <p><strong>Shipping Address:</strong> <?php echo $trans['trans']->address.', '.$trans['trans']->kecamatan.', '.$trans['trans']->kota.', '.$trans['trans']->propinsi.', '.$trans['trans']->kodepos; ?></p>
    <p><strong>Recipient:</strong> <?php echo $trans['trans']->firstname_receiver.' '.$trans['trans']->lastname_receiver.' (phone: '.$trans['trans']->phone.')'; ?></p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach ($detil as $key => $value) { ?>
    		<tr>
		        <td><?php echo $value->name; if(!empty($value->variantname)) { echo ' (variant: '.$value->variantname.')'; } ?></td>
		        <td><?php echo $value->qty;  ?></td>
		        <td>Rp. <?php echo number_format($value->harga,0,',','.');  ?></td>
		        <td>Rp. <?php echo number_format($value->harga*$value->qty,0,',','.');  ?></td>
		      </tr>
    	<?php } ?>
      
      <!-- Repeat the above row for each product in the order -->
    </tbody>
    <tfoot>
    	<?php if($trans['trans']->discount >0) { ?>
      <tr>
        <td colspan="3">Discount (Voucher: [<?php echo $trans['trans']->voucher_code; ?>])</td>
        <td>- Rp. <?php echo number_format($trans['trans']->discount,0,',','.'); ?></td>
      </tr>
  <?php } ?>
      <tr>
        <td colspan="3">Shipping Cost</td>
        <td>Rp. <?php echo number_format($trans['trans']->shipping_cost,0,',','.'); ?> (<?php echo $trans['trans']->shipping_service; ?>)</td>
      </tr>
    <?php if($trans['trans']->discount_ongkir >0) { ?>
      <tr>
        <td colspan="3">Discount Ongkir (Voucher: [<?php echo $trans['trans']->voucher_ongkir_code; ?>])</td>
        <td>- Rp. <?php echo number_format($trans['trans']->discount_ongkir,0,',','.'); ?></td>
      </tr>
    <?php } ?> 
      <tr>
        <td colspan="3" class="total">Order Total</td>
        <td>Rp. <?php echo number_format($trans['trans']->total_trans+$trans['trans']->shipping_cost-$trans['trans']->discount-$trans['trans']->discount_ongkir,0,',','.'); ?> </td>
      </tr>
    </tfoot>
  </table>

  <div class="footer">
    <p>Thank you for your order!</p>
    <p><?php echo $setting->website_name.' ('.base_url().')'; ?></p>
    <p><?php echo $setting->email; ?></p>
  </div>
</body>
</html>
