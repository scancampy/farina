<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style type="text/css">
            * {
                font-size: 12px;
                font-family: 'Arial';
            }

            td,
            th,
            tr,
            table {
                border-top: 1px solid black;
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 75px;
                max-width: 75px;
            }

            td.quantity,
            th.quantity {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            td.price,
            th.price {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
              
            }

            img {
                max-width: 30mm;
            }

            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
        <title>Receipt #<?php echo $trans['trans']->id; ?></title>
    </head>
    <body>
        <div class="ticket">
            <img src="https://farinafemme.com/images/logo.png" alt="Logo">
            <p class="">
                Order ID: <strong><?php echo $trans['trans']->id; ?></strong><br/>
                Order Date: <strong><?php echo strftime("%d %B %Y", strtotime($trans['trans']->order_placed_date)); ?></strong><br/><br/>
                Shipping Address:<br/><?php echo $trans['trans']->address.', '.$trans['trans']->kecamatan.', '.$trans['trans']->kota.', '.$trans['trans']->propinsi; ?><br/><br/>
                Recipient:<br/><?php echo $trans['trans']->firstname_receiver.' '.$trans['trans']->lastname_receiver.' (phone: '.$trans['trans']->phone.')'; ?>
                <br/>
                <br/>
                Item(s) Purchased:
            </p>
            <p>
                <?php foreach ($detil as $key => $value) { ?>
                    <strong><?php echo $value->name; ?></strong>
                    <br/>
                    <?php if($value->variantname != '') {
                        echo '<br/>Variant: '.$value->variantname;
                    } ?>
                    <?php echo '<br/>Qty: '.$value->qty; ?>
                    <?php echo '<br/>Price: Rp. '.number_format($value->harga,0, ",",".").'<br/><br/>'; ?>
               <?php } ?>
            </p>
           
            <p class="centered">Thanks for your purchase<br/>
https://farinafemme.com<br/>
Contact: 087732943090<br/>
Instagram/tiktok: @farinafemme</p>
        </div>
       
        <script>
            (function() {
   window.print();
})();
           
        </script>
    </body>
</html>