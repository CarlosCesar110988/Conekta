<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Conecta Banorte</title>

<style>
.normal{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;}
</style>

</head>

<?php
	$service_name = $_POST['service_name'];
	$service_number = $_POST['service_number'];
    $reference = $_POST['reference'];
    
    $monto = $_POST['monto'];
    $concepto = $_POST['concepto'];
?>

<body>
<center>
<table width="800" border="0" cellpadding="10" cellspacing="0" class="normal">
<tr>
    <td align="center"><strong>PAGO EN BANORTE</strong></td>
    </tr>
     <tr>
    <td align="center">Imprime y presenta este comprobante en cualquier sucursal Banorte del país para realizar el paso por tu compra</td>
    </tr>
  <tr>
    <td align="center"><img src="http://siiafhacienda.gob.mx/images/logo_banorte_250x71.jpg" /></td>
  </tr>
  <tr>
    <td align="center">Nombre: <?php echo $service_name ?></td>
    </tr>
  <tr>
    <td align="center">Cuenta: <?php echo $service_number ?></td>
    </tr>
  <tr>
    <td align="center">Referencia: <?php echo $reference ?></td>
    </tr>
  <tr>
    <td align="center">Monto a pagar: $<?php echo $monto ?> M.N.</td>
    </tr>
    <tr>
    <tr>
    <td align="center">Concepto: <?php echo $concepto ?></td>
    </tr>
    <tr>
    <td align="center"><p>
      <input type="button" name="button" id="button" value="Imprimir" onclick="window.print()" />
    </p></td>
    </tr>
</table>
</center>
</body>
</html>