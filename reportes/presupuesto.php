<?php
include_once("../modelo/clsPresupuesto.php");
require "fpdf.php";
// 
$numero_presupuesto = $_GET['n_presupuesto'];



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
			 header("Content-Type: text/html; charset=iso-8859-1 ");			
		}
	function celdaAzul(){
   		$this->SetFillColor(0, 112, 185);
   }
   function celdaGris(){
   		$this->SetFillColor(221,221,221);
   }
      function celdaBlanca(){
   		$this->SetFillColor(255,255,255);
   }
}
//buscar la factura
//se crea el Objeto Factura de la clase Factura
	$objPresupuesto = new clsPresupuesto();
//y se envia el numero de la factura capturado por el metodo GET
	$objPresupuesto->reportepdf($numero_presupuesto);
//se busca la factura
	$objPresupuesto->buscar_presupuestoydetalle();

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
$n="";
//se busca el array de la cunsulta 
while($presupuestoPDF = $objPresupuesto->row())
{

//validar que el numero de factura no sea el mismo para que no se imprima 2 veces
if($presupuestoPDF['cod_presu'] !=  $n ){
	$n=$presupuestoPDF['cod_presu'];
$totalpresupuesto=$presupuestoPDF['tot_presu'];
$sub_total=$presupuestoPDF['sub_total_presu'];
$monto_iva=$presupuestoPDF['monto_iva_presu'];
$val_iva=$presupuestoPDF['val_iva'];
			//SE LLEMA A LA FUNCION PARA ARREGLAR LA FECHA

			$fecha=fsFecha($presupuestoPDF['fec_presu']);
			$fechaven=fsFecha($presupuestoPDF['ven_presu']);

//Logo
			$pdf->Image('../imagenes/logo.jpg',20,18,55,15);
//Direccion
			$mar_izq=80;
			$mar_izq2=67;
			$anchoc4=5;
			$anchoc5=68;
			$mizq=130;
			$mizq2=92;
			$anchoc1=38;
			$anchoc2=38;
			$anchoc3=38;
			$alto=8;$alto1=5;
			$border=1;
			$aligndata='R';
			$pdf->SetX($mar_izq);
			$pdf->SetX( $mar_izq+65);    
			$pdf->Cell($anchoc3,$alto1,'PRESUPUESTO N°: ',0,0,$aligndata);
			$pdf->SetX( $mar_izq+$anchoc5+$anchoc4);    
			$pdf->Cell(32,$alto1,$presupuestoPDF['cod_presu'],0,0,$aligndata);
			$pdf->SetX( $mar_izq);
			$pdf->MultiCell(40,$alto1,"RIF: J-40391423-0",0,'R' ); 

			$pdf->SetX($mar_izq2);
			$pdf->SetX( $mar_izq2+78);    
			$pdf->Cell($anchoc3,$alto1,'FECHA EMISION: ',0,0,$aligndata);
			$pdf->SetX( $mar_izq2+78+15);    
			$pdf->Cell($anchoc2,$alto1,$fecha,0,0,$aligndata);
			$pdf->SetX( $mar_izq2);
			$pdf->MultiCell($anchoc5,$alto1,"Av. 30 Esquina Calle 35 Local N° 1 y 2,",0,'R' ); 

			$pdf->SetX($mar_izq2);
			$pdf->SetX( $mar_izq2+77);    
			$pdf->Cell(39,$alto1,'FECHA VENCIMIENTO: ',0,0,$aligndata);
			$pdf->SetX( $mar_izq2+77+16);    
			$pdf->Cell($anchoc2,$alto1,$fechaven,0,0,$aligndata);
			$pdf->SetX( $mar_izq2);
			$pdf->MultiCell(70,$alto1,"Sector Centro Acarigua - Edo, Portuguesa",0,'R' ); 


			$pdf->Cell(0, 4, 'TLF. 0255-664.06.25', 0, 1, 'C');
			$pdf->Cell(0, 4, 'Email: rjatlantico@gmail.com', 0, 1, 'C');

			

			$pdf->Ln(5);
				
			//CLIENTE
			
			$pdf->celdaBlanca();
			$pdf->Cell(40, 8, 'RIF/CI: '.$presupuestoPDF['rif_cli'], 1, 0, 'L');
			$pdf->Cell(146, 8, ' NOMBRE O RAZON SOCIAL: '.$presupuestoPDF['nom_cli'], 1, 1, 'L');
			$pdf->Cell(40, 8, 'TELEFONO: '.$presupuestoPDF['tlfn_cli'], 1, 0, 'L');
			$pdf->Cell(146, 8, ' CORREO: '.$presupuestoPDF['correo_cli'], 1, 1, 'L');
			$pdf->MultiCell(186, 8, utf8_decode('DIRECCION: '.$presupuestoPDF['dir_cli']), 1, 1, 'L');
			$pdf->Cell(93, 8, 'ELABORADO POR: '.$presupuestoPDF['nom_usu'].' '.$presupuestoPDF['ape_usu'], 1, 0, 'L');
			$pdf->Cell(93, 8, ' TELEFONO: '.$presupuestoPDF['correo_cli'], 1, 1, 'L');
			

			if ($presupuestoPDF['tipo_pago']==1) {
				$pdf->Cell(80, 8, 'TIPO DE PAGO: CHEQUE', 0, 1, 'L');
				$pdf->Cell(58, 8, 'ABONO: '.$presupuestoPDF['abo_pre'], 1, 0, 'L');
				$pdf->Cell(58, 8, 'RESTANTE: '.$presupuestoPDF['res_pre'], 1, 1, 'L');
			}
			if ($presupuestoPDF['tipo_pago']==2) {
				$pdf->Cell(80, 8, 'TIPO DE PAGO: EFECTIVO', 0, 1, 'L');
				$pdf->Cell(58, 8, 'ABONO: '.$presupuestoPDF['abo_pre'], 1, 0, 'L');
				$pdf->Cell(58, 8, 'RESTANTE: '.$presupuestoPDF['res_pre'], 1, 1, 'L');
			}
			if ($presupuestoPDF['tipo_pago']==3) {
				$pdf->Cell(70, 8, 'TIPO DE PAGO: TRANSFERENCIA', 1, 0, 'L');
				$pdf->Cell(58, 8, 'ABONO: '.$presupuestoPDF['abo_pre'], 1, 0, 'L');
				$pdf->Cell(58, 8, 'RESTANTE: '.$presupuestoPDF['res_pre'], 1, 1, 'L');
			}
			$pdf->Ln(4);
			//MOSTRAMOS LA TABLA
			$pdf->celdaAzul();
			$pdf->Cell(10, 7, 'CANT', 1, 0, 'C',true);
			$pdf->Cell(100, 7, 'DESCRIPCION', 1, 0, 'C',true);
			$pdf->Cell(38, 7, 'PRECIO UNIT. Bs.', 1, 0, 'C',true);
			$pdf->celdaGris();
			$pdf->Cell(38, 7, 'TOTAL Bs.', 1, 1, 'C',true);
	}
	$pdf->SetFont("Arial", "", 9);

		$pdf->Cell(10, 8,$presupuestoPDF['can_pro'], 1, 0, 'C');
		$pdf->Cell(100, 8,$presupuestoPDF['nom_pro'], 1, 0, 'L');
		$pdf->Cell(38, 8, $presupuestoPDF['cos_sin_iva'], 1, 0, 'R');
		$pdf->Cell(38, 8, $presupuestoPDF['cos_total'], 1, 1, 'R');

}
$pdf->Cell(100, 8,'Tiempo de Ejecución del Trabajo 21 días hábiles', 'L', 0, 'L');

$pdf->SetX( $mizq+$anchoc1);    
$pdf->Cell($anchoc2,$alto,$sub_total,$border,0,$aligndata);
$pdf->SetX( $mizq);
$pdf->MultiCell($anchoc1,$alto,"SUB-TOTAL",1,'R' );  
$pdf->Cell(100, 8,'80% del costo total para la formalización del pedido', 'L', 0, 'L');

$pdf->SetX( $mizq+$anchoc1);    
$pdf->Cell($anchoc2,$alto,"",$border,0,$aligndata);
$pdf->SetX( $mizq);
$pdf->MultiCell($anchoc1,$alto,"DESCUENTO",1,'R' );  
$pdf->Cell(100, 8,'20% restante a la entrega del pedido', 'L', 0, 'L');

$pdf->SetX( $mizq2+$anchoc1+$anchoc2);    
$pdf->Cell($anchoc2,$alto,$monto_iva,$border,0,$aligndata);
$pdf->SetX( $mizq2+$anchoc1);    
$pdf->Cell($anchoc3,$alto,$sub_total,$border,0,$aligndata);
$pdf->SetX( $mizq2+23);
$pdf->MultiCell(15,$alto,"IVA ".$val_iva."%",1,'R' ); 
$pdf->Cell(110, 8,'No se modifican pedidos ya formalizado (ni tallas ni cantidades)', 'LB', 0, 'L');
$pdf->SetX( $mizq+$anchoc1);    
$pdf->Cell($anchoc2,$alto,$totalpresupuesto,$border,0,$aligndata);
$pdf->SetX( $mizq);
$pdf->MultiCell($anchoc1,$alto,"TOTAL",1,'R' );  




$pdf->Output();
//$pdf->Output("Contrato_".$per_Rut."-".$per_DV.".pdf","D");



?>
