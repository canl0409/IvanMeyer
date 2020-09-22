<style>
    .left{
        float: left;
    }
    .right{
        float: right;
    }
ul.products {
	padding: 0;
	margin: 0;
	max-width: 740px;
	margin-left: auto;
	margin-right: auto;
}
ul.products li {
	display: inline-block;
	max-width: 200px;
	padding: 10px;
	background-color: #FFFFFF;
	margin: 10px;
	border: 1px solid #EAEAEA;
	color: #3D3D3D;
}
ul.products li h3 {
	margin: -10px -10px 10px -10px;
	padding: 10px;
	text-align: center;
	background-color: #F5F5F5;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 1.1em;
	color: #5A5A5A;
}
ul.products li fieldset {
	border: none;
	padding: 5px 5px 5px 0px;
	margin: 0;
}
ul.products li fieldset label{
	display:block;
	margin-bottom: 4px;
}
ul.products li fieldset label span{
	width: 80px;
	float: left;
}
ul.products li fieldset label select{
	min-width: 100px;
}

button, .button{
	background-color: #39b3d7;
	min-width: 100px;
	border: none;
	padding: 10px;
	display: inline-block;
	text-align: center;
	cursor: pointer;
	text-decoration: none;
	color: #FFF;
	min-height: 15px;
	font: 12px/15px Arial, Helvetica, sans-serif;
	text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.26);
	border-radius: 3px;
}
button:hover, .button:hover{
	background-color: #44C7ED;
}

.product-thumb{
	text-align:center;
}
.product-desc {
	font-style: italic;
	font-size: 0.8em;
	margin-bottom: 4px;
	height: 40px;
	overflow: hidden;
	margin-top: 5px;
}

ul.shopping-cart{
	position: fixed;
	top: 100px;
	right: 0;
	background-color: #F9F9F9;
	padding: 10px;
	min-width: 250px;
	list-style: none;
	font-size: 0.8em;
	border: 1px solid #F0F0F0;
}
ul.shopping-cart .cart-itm {
	margin-bottom: 10px;
	border-bottom: 1px solid #ddd;
	padding-bottom: 8px;
}
ul.shopping-cart .cart-itm:last-child{
	border-bottom: none;
	margin-bottom: 0px;
}
ul.shopping-cart .cart-itm .remove-itm{
	float: right;
	font-size: 1.5em;
}
ul.shopping-cart .cart-itm .remove-itm a{
	text-decoration:none;
	color:#000;
}
.cart-total-text a{
	float:right;
}

.cart-view-table-front{
	font-size: 0.7em;
    position: fixed;
    z-index: 9999;
    right: 10px;
    bottom: 50px;
	width: 350px;
	font-family: Arial
}
.cart-view-table-front h3{
	text-align: center;
	padding: 0;
	margin: 0px 0px 6px 0px;
}
.cart-view-table-front, .cart-view-table-back {
	max-width: 700px;
	background-color: #FFFFFF;
	margin-left: auto;
	margin-right: auto;
	padding: 10px;
	box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.12);
	border: 1px solid #E4E4E4;
}
.cart-view-table-front table th, .cart-view-table-back table th{
	text-align: left;
}
.cart-view-table-front table thead, .cart-view-table-back table thead{
	background-color: #e0e0e0;
	text-transform: uppercase;
}
.cart-view-table-front table tbody tr.even, .cart-view-table-back table tbody tr.even{
	background-color: #F7F7F7;
}
.cart-view-table-front table tbody tr.odd, .cart-view-table-back table tbody tr.odd{
	background-color: #EDEDED;
}
.cart-view-table-front button, .cart-view-table-front .button, .cart-view-table-back button, .cart-view-table-back .button{
	margin: 10px 1px;
	float: right;
}
</style>

<?php

if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
    echo '<div class="cart-view-table-front" id="view-cart">';
    echo '<h3 style="font-weight: bold;">Seu carrinho</h3>';
    echo "<form method='post' action='".u."carrinho/cart_update.php'>";
    echo "<table class='table'>";
    echo '<thead>';
    echo '<th>Curso</th>';
    echo '<th>Ação</th>';
    echo '</thead>';
    echo '<tbody>';

    $total =0;
    foreach ($_SESSION["cart_products"] as $cart_itm)
    {
        $product_name = $cart_itm["product_name"];
        $product_qty = $cart_itm["product_qty"];
        $product_price = $cart_itm["product_price"];
        $product_code = $cart_itm["product_code"];
        $product_color = $cart_itm["product_color"];
        echo '<tr>'; ?>

        <td><span style="font-size: 11px"><?= $product_name; ?></span></td>

        <?php
        echo '<td><div class="checkbox" style="margin: 0"><label><input type="checkbox" name="remove_code[]" value="'.$product_code.'" style="margin-top: 0"/> Remover</label></div></td>';
        echo '</tr>';
        $subtotal = ($product_price * $product_qty);
        $total = ($total + $subtotal);
    }

    echo '</tbody>';
    echo '</table>';

	echo "<a href='".u."cart/view.php' class='btn btn-danger right' style='background-color: #d9534f' onclick='return btnFinalizarCarrinho()'>Finalizar</a>";
	echo '<button type="submit" class="btn btn-danger left" style="margin: 0 12px; background-color: #d9534f">Atualizar</button>';

    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
    echo '</form>';
    echo '</div>';

}
?>
