<?php
include_once("../modelo/clsFactura.php");
require "fpdf.php";
// 
$numero_factura = $_GET['n_factura'];



function convert_mes($lsMes){
	//array para la fecha 
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	//para asignar a la variable $mes el mes segun el array
return $meses[$lsMes-1];
}


function fsFecha($psFecha)
		{
			$lsHoy=date("Y-m-d");
			if(strlen($psFecha)==10)
			{
				$lsDia=substr($psFecha,8,2);
				$lsMes=substr($psFecha,5,2);
				$lsAno=substr($psFecha,0,4);
				$lsHoy=$lsDia."-".$lsMes."-".$lsAno;
			}
			return $lsHoy;
		}

class PDF extends FPDF
{

function Header()
		{
						
		}
	function celdaRoja(){
   		$this->SetFillColor(221,45,45);
   }
   function celdaGris(){
   		$this->SetFillColor(221,221,221);
   }
   
}
//buscar la factura
//se crea el Objeto Factura de la clase Factura
	$objFactura = new clsFactura();
//y se envia el numero de la factura capturado por el metodo GET
	$objFactura->reportepdf($numero_factura);
//se busca la factura
	$objFactura->buscar_facturaydetalle();

//DELCARACION DE LA HOJA
$pdf=new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de página


//DATOS DEL TITULO
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont("Arial", "b", 8);


$contador=1;//cuenta el numero de detalles

//se busca el array de la cunsulta 
while($facturaPDF = $objFactura->row())
{

//validar que el numero de factura no sea el mismo para que no se imprima 2 veces
if($facturaPDF['nro_fac'] !=  $n ){
	$n=$facturaPDF['nro_fac'];
$totalfactura=$facturaPDF['tot_fac'];
			//SE LLEMA A LA FUNCION PARA ARREGLAR LA FECHA

			$fecha=fsFecha($facturaPDF['fec_fac']);
			$fechaven=fsFecha($facturaPDF['fec_ven']);

//Logo
			$pdf->Image('../imagenes/logo.jpg',20,18,55,15);
//Direccion
			$pdf->Cell(0, 4, 'Av. 14 - Casa N°: 06 - Urb. Villa Araure I', 0, 1, 'C');
			$pdf->Cell(0, 4, 'Telefono: 0255-615.37.58 // 0416-152.19.00.', 0, 1, 'C');
			$pdf->Cell(0, 4, 'Araure - Edo. Portuguesa', 0, 1, 'C');
			$pdf->Cell(0, 4, 'RIF: V-05941616-9', 0, 1, 'C');
			

			$pdf->Cell(160, 5, 'FACTURA N°: ', 0, 0, 'R');
			$pdf->Cell(0, 5, $facturaPDF['nro_fac'], 0, 1, 'L');
			$pdf->Cell(174, 5, 'EMITIDA EN:   ARAURE', 0, 1, 'R');
			$pdf->Cell(160, 5, 'FECHA EMISION: ', 0, 0, 'R');
			$pdf->Cell(0, 5, $fecha, 0, 1, 'R');
			$pdf->Cell(160, 5, 'FECHA VENCIMIENTO: ', 0, 0, 'R');
			$pdf->Cell(0, 5, $fechaven, 0, 1, 'R');
			

			$pdf->Ln(5);
				
			//CLIENTE
			$pdf->celdaRoja();
			$pdf->Cell(160, 2, '', 1, 1, 'L',tre);
			$pdf->Cell(160, 5, 'RIF/CI: '.$facturaPDF['rif_cli'], 'RL', 1, 'L');
			$pdf->Cell(160, 5, 'NOMBRE O RAZON SOCIAL: '.$facturaPDF['pers_cli'].'('.$facturaPDF['nom_cli'].')', 'RL', 1, 'L');
			$pdf->Cell(160, 5, 'TELEFONO: '.$facturaPDF['tlfn_cli'], 'RLB', 1, 'L');
			$pdf->Ln(2);

			if ($facturaPDF['tip_com']==1) {
				$pdf->Cell(80, 7, 'CONDICION PAGO: EFECTIVO', 0, 1, 'L');
			}
			if ($facturaPDF['tip_com']==2) {
				$pdf->Cell(80, 7, 'CONDICION PAGO: CREDITO', 0, 1, 'L');
			}
			if ($facturaPDF['tip_com']==3) {
				$pdf->Cell(80, 7, 'CONDICION PAGO: CHEQUE', 0, 1, 'L');
			}
			//MOSTRAMOS LA TABLA
			$pdf->Cell(8, 7, 'Nr°', 1, 0, 'C',true);
			$pdf->Cell(70, 7, 'PRODUCTO', 1, 0, 'C',true);
			$pdf->Cell(14, 7, 'CESTAS', 1, 0, 'C',true);
			$pdf->Cell(22, 7, 'PESO BRUTO', 1, 0, 'C',true);
			$pdf->Cell(20, 7, 'PESO NETO', 1, 0, 'C',true);
			$pdf->Cell(28, 7, 'PRECIO UNITARIO', 1, 0, 'C',true);
			$pdf->celdaGris();
			$pdf->Cell(23, 7, 'PRECIO TOTAL', 1, 1, 'C',true);
	}
	$pdf->SetFont("Arial", "", 9);

		$pdf->Cell(8, 10,$contador++, 'RL', 0, 'C');
		$pdf->Cell(70, 10,$facturaPDF['nom_pro'], 'RL', 0, 'L');
		$pdf->Cell(14, 10, $facturaPDF['can_ven_pro'], 1, 0, 'C');
		$pdf->Cell(22, 10, $facturaPDF['pesob_pro'], 1, 0, 'C');
		$pdf->Cell(20, 10, $facturaPDF['peson_pro'], 1, 0, 'C');
		$pdf->Cell(28, 10, $facturaPDF['pre_ven_pro']." Bs", 1, 0, 'C');
		$pdf->Cell(23, 10, $facturaPDF['tot_pro']." Bs", 1, 1, 'C');

$cestas=$cestas+$facturaPDF['can_ven_pro'];
$pesob=$pesob+$facturaPDF['pesob_pro'];
}
$pdf->Cell(78, 3,'', 'T', 1, 'L');
$pdf->Cell(78, 10, 'TOTALES: ', 'BTL', 0, 'C');
$pdf->Cell(14, 10, $cestas, 'BT', 0, 'C');
$pdf->Cell(22, 10, $pesob, 'BT', 0, 'C');
$pdf->Cell(71, 10, 'Estos precios incluyen IVA       '.$totalfactura." Bs     ", 'BTR', 1, 'R');


$pdf->ln(10);
$pdf->Write(4, 'RECIBIDO CONFORME:_____________________________________________________________________________');
$pdf->ln(10);
$pdf->Write(4, 'LOS PRODUCTOS ESPECIFICADOS EN ESTA FACTURA, HAN SIDO ACEPTADOS POR EL CLIENTE EN OPTIMAS CONDICIONES SANITARIAS .');
$pdf->ln(6);
$pdf->Cell(180, 3,'', 'T', 1, 'L');


$pdf->Output();
//$pdf->Output("Contrato_".$per_Rut."-".$per_DV.".pdf","D");



?>
