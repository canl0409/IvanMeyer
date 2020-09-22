<?php
session_start();
include_once("config.php");

$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<?php 
include_once("header.php");
?>

<body>
<?php include("navbar.php"); ?>
<h1 class="text-center">planos </h1>
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
    echo '<div class="cart-view-table-front" id="view-cart">';
    echo '<h3>Seu carrinho</h3>';
    echo '<form method="post" action="cart_update.php">';
    echo '<table width="100%"  cellpadding="6" cellspacing="0">';
    echo '<tbody>';

    $total =0;
    foreach ($_SESSION["cart_products"] as $cart_itm)
    {
        $product_name = $cart_itm["product_name"];
        $product_qty = $cart_itm["product_qty"];
        $product_price = $cart_itm["product_price"];
        $product_code = $cart_itm["product_code"];
        $product_color = $cart_itm["product_color"];
        echo '<tr>';
        echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
        echo '<td>'.$product_name.'</td>';
        echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
        echo '</tr>';
        $subtotal = ($product_price * $product_qty);
        $total = ($total + $subtotal);
    }
    echo '<td colspan="4">';
    echo '<a class="btn btn-danger" type="submit">Atualizar</a><a href="view_cart.php" class="btn btn-danger">Finalizar</a>';
    echo '</td>';
    echo '</tbody>';
    echo '</table>';
    
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
    echo '</form>';
    echo '</div>';

}
?>

<?php

$results = $mysqli->query("SELECT * FROM planos ORDER BY planoId ASC");
if($results){ 
$products_item = '<ul class="products">';

while($obj = $results->fetch_object())
{

    if ($obj->valor>0) {
        $valor_parcela=$obj->valor/$obj->parcelas;
    } else {
        $valor_parcela=0.0;
    }
$idpage = $obj->planoId;
$products_item .= <<<EOT
    <li class="product">
    <form method="post" action="cart_update.php">
    <div class="product-content"><h3>{$obj->nome}</h3>
    <div class="product-desc">{$obj->caracteristicas}</div>
    <div class="product-info">
    Preço {$currency} {$valor_parcela} 
    
    <fieldset>
    
    <label>
        <input type="hidden" size="2" maxlength="2" name="product_qty" value="1" />
    </label>
    
    </fieldset>
    <input type="hidden" name="product_code" value="{$obj->planoId}" />
    <input type="hidden" name="type" value="add" />
    <input type="hidden" name="return_url" value="{$current_url}" />
    <div align="center"><button type="submit" class="btn btn-danger"><a href="$idpage.php">Add</a></button></div>
    </div></div>
    </form>
    </li>
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?> 

<hr>

<h1 class="text-center">cursos </h1>

<?php
$results = $mysqli->query("SELECT * FROM cursos ORDER BY cursoId ASC");
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
    <li class="product">
    <form method="post" action="cart_update.php">
    <div class="product-content"><h3>{$obj->titulo}</h3>
    <div class="product-thumb"><img src="images/{$obj->thumb}"></div>
    <div class="product-desc">{$obj->descricao}</div>
    <div class="product-info">
    Preço {$currency} {$obj->valor} 
    
    <fieldset>
    
    <label>
        <input type="hidden" size="2" maxlength="2" name="product_qty" value="1" />
    </label>
    
    </fieldset>
    <input type="hidden" name="product_code" value="{$obj->cursoId}" />
    <input type="hidden" name="type" value="add" />
    <input type="hidden" name="return_url" value="{$current_url}" />
    <div align="center"><button type="submit" class="btn btn-danger">Comprar</button></div>
    </div></div>
    </form>
    </li>
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>    
<!-- Products List End -->
</body>

<?php 
include 'footer.php';
?>
