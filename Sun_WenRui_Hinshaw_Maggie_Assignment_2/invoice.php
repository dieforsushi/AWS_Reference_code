<html>
     <head>
<style>
    body {
    background-repeat: no-repeat;
    background-position: right;
    background-attachment: fixed;
}
            body {background-color: cornsilks}
            h1 {color: black}
            p {color: black}
            table {background-color: beige}
        </style>        
    </head>
<?php
include 'beer.php';
//displaying the invoice 
$quantity=$_GET['quantity'];
$subtotal = 0;
            for ($i = 0; $i < count($types_of_beers); $i++) {
                $extended_price[$i] = $types_of_beers[$i]['price'] * $quantity[$i];
                $subtotal = $subtotal + $extended_price[$i];
            }

            /// rate rate
            $tax_rate = 1.04712;
            $tax = $tax_rate * $subtotal;

            //shipping cost
            if ($subtotal < 50) {
                $shipping = 2;
            } elseif ($subtotal < 100) {
                $shipping = 5;
            } else {
                $shipping = .5 * $subtotal;
            }
            $total = $subtotal + $tax + $shipping;
            ?>

<table style="border-collapse: inherit; width: 514px; height: 319px;" border="2" bordercolor="BLACK" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td align="center" width="43%"><b>Item</b></td>
            <td width="11%"><b>quantity</b></td>
            <td style="text-align: center;" width="13%"><b>price</b></td>
            <td style="text-align: center;" width="54%"><b>extended price</b></td>
        </tr>
                    <?php
                    // print the table for the invoice
                    for ($i = 0; $i < count($types_of_beers); $i++) {    
                        if($quantity[$i]> 0) {
                        
                        printf('
    <tr>
      <td width="43%%">%s</td>
      <td align="center" width="11%%">%d</td>
      <td style="text-align: center;" width="13%%">$ %.2f</td>
      <td style="text-align: center;" width="54%%">$ %.2f</td>
    </tr>
    ', $types_of_beers[$i]['brand'], $quantity[$i], $types_of_beers[$i]['price'], $extended_price[$i]);
                    }
                    }

// compute tax
?>
        <tr>
            <td colspan="4" width="100%">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" width="67%">Sub-total</td>
            <td style="text-align: center;" width="54%">$<?php printf('%.2f', $subtotal); ?></td>
        </tr>
        <tr>
            <td colspan="3" width="67%"><font face="arial">Tax @ 4.712%</font></td>
            <td style="text-align: center;" width="54%">$<?php printf('%.2f', $tax); ?></td>
        </tr>
        <tr>
            <td colspan="3" width="67%"><font face="arial">Shipping</font></td>
            <td style="text-align: center;" width="54%">
                $ <?php printf('%.2f', $shipping); ?></td>
        </tr>
        <tr>
            <td colspan="3" width="67%"><b>Total</b></td>
            <td style="text-align: center;" width="54%"><b>$<?php printf('%.2f', $total); ?></b></td>
        </tr>
        
    </tbody>
</table>
    <form>
        <center>
        <body background="./imgs/homer.jpg" opacity: 1.0;>
    </center>
    </form>
</body> 
</html>

