<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Conecta OXXO</title>

<style>
.normal{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;}
</style>

</head>

<?php
	$barras = $_POST['barras'];
	$numero = $_POST['numero'];
    $expira = $_POST['expira'];
    $monto = $_POST['monto'];
    $concepto = $_POST['concepto'];
?>

<body>
<center>
<table width="800" border="0" cellpadding="10" cellspacing="0" class="normal">
<tr>
    <td align="center"><strong>PAGO EN TIENDAS OXXO</strong></td>
    </tr>
     <tr>
    <td align="center">Imprime y presenta este comprobante en cualquier tiene OXXO del país para realizar el paso por tu compra</td>
    </tr>
  <tr>
    <td align="center"><img src="http://www.oxxo.com/images/logo-oxxo.png" /></td>
  </tr>
  <tr>
    <td align="center"><img src="<?php echo $barras ?>" /></td>
    </tr>
  <tr>
    <td align="center"><?php echo $numero ?></td>
    </tr>
  <tr>
    <td align="center">Fecha de vencimiento: <?php echo $expira ?></td>
    </tr>
  <tr>
    <td align="center">Monto a pagar: $<?php echo $monto ?> M.N.</td>
    </tr>
    <tr>
    <tr>
    <td align="center">Concepto: <?php echo $concepto ?></td>
    </tr>
    <tr>
    <td align="center"><p>La tienda donde se efectué el pago cobrara $8 (pesos) en concepto de recepción de cobranza.</p>
      <p>
        <input type="button" name="button" id="button" value="Imprimir" onclick="window.print()" />
      </p></td>
    </tr>
</table>
</center>
</body>
</html>