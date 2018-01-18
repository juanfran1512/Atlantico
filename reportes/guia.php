<?php
include_once("../modelo/clsDetalleFactura.php");
include_once("../modelo/clsFactura.php");
require "fpdf.php";

$numero_factura = $_GET['n_factura'];
//array para la fecha 
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//para asignar a la variable $mes el mes segun el array
$mes=$meses[date('n')-1];

//se le asigna a la cada variable el dia y año
									$dia=date("d");
									$ano=date("Y");

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
			//Logo
			$this->Image('../imagenes/logo.jpg',60,8,100,20);
			$this->Ln(24);			
		}

function letraSub() 
	{		
		$this->SetFont('Arial','U',8);
	}
	function letraNegrita() 
	{		
		$this->SetFont('Arial','B',8);
	}
	function letraNormal()
    {
        $this->SetFont('Arial','',8);   
    }
    function letraPeq(){
    	$this->SetFont('Arial','',6);
    }

   function celdaRoja(){
   		$this->SetFillColor(221,221,221);
   }

}//se crea el Objeto Factura de la clase Factura
	$objFactura = new clsFactura();
//y se envia el numero de la factura capturado por el metodo GET
	$objFactura->reportepdf($numero_factura);
//se busca la factura 
	$objFactura->buscar();




//buscar la factura____________________________
//se crea el Objeto Factura de la clase Factura
	$objDetalle = new clsDetalleFactura();
//y se envia el numero de la factura capturado por el metodo GET
	$objDetalle->usar_nfactura($numero_factura);
//se busca la factura 
	$objDetalle->buscar();


//_____________________________________________________________________]




//DELCARACION DE LA HOJA
$pdf=new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de página


//DATOS DEL TITULO
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont("Arial", "b", 8);

//contador para comparar
$i=0;
//variable para acumular los pollos despresados 
$cant=0;
//PARA COMPARAR el nro de la factura
$n='';
//se busca el array de la cunsulta
while($facturaPDF = $objFactura->row())
{

//validar que el numero de factura no sea el mismo para que no se imprima 2 veces
if($facturaPDF['nro_fac'] !=  $n ){
	$n=$facturaPDF['nro_fac'];
$fecha=fsFecha($facturaPDF['fec_fac']);
$fechaven=fsFecha($facturaPDF['fec_ven']);

	//contenido
	$pdf->Write(4,'LAS EMPRESAS "IMPORTADORAS" QUEDAN AUTORIZADAS A CIRCULAR CON LOS DATOS DEL CONDUCTOR Y TRANSPORTE DE FORMA MANUAL.');
	$pdf->ln(6);
			$pdf->Cell(150, 5, 'FECHA EMISION: ', 0, 0, 'R');
			$pdf->Cell(0, 5, $fecha, 0, 1, 'R');
			$pdf->Cell(150, 5, 'FECHA VENCIMIENTO: ', 0, 0, 'R');
			$pdf->Cell(0, 5, $fechaven, 0, 1, 'R');

	//FILA 1
	$pdf->celdaRoja();
	$pdf->Cell(160, 7, 'GUIA DE SEGUIMIENTO Y CONTROL DE PRODUCTOS ALIMENTICIOS TERMINADOS', 1, 0, 'C', true);
	$pdf->Cell(20, 7, 'Nro. GUIA', 1, 1, 'C', true);
	//FILA 2
	$pdf->letraNormal();
	$pdf->Cell(160, 4, 'EN CASO DE COMPROBARSE ALTERACIONES EN LOS DATOS O QUE LOS MISMOS SON FALSOS, LA GUIA SERA ', 'LR', 0, 'C'); 
	$pdf->Cell(20, 4, '', 'LR', 1, 'C');
	   
	$pdf->Cell(160, 4, 'ANULADA Y SE Y SE APLICARAN LAS SANCIONES CORRESPONDIENTES', 'LR', 0, 'C');
	$pdf->Cell(20, 4, $facturaPDF['nro_fac'], 'LR', 1, 'C');

	$pdf->Cell(160, 5, 'NOTA:Esta guia NO SUPRIME la existencia de otros documentos requeridos para la movilizacion de productos ', 'LR', 0, 'C');
	$pdf->Cell(20, 5, '', 'LR', 1, 'C');

	$pdf->Cell(160, 5, 'alimenticios (permisos, Sanitarios, Facturas, Recibos, Etc ) ', 'LR', 0, 'C');
	$pdf->Cell(20, 5, '', 'LR', 1, 'C');
	//FILA 3
	$pdf->letraNegrita();
	$pdf->Cell(180, 5, 'DATOS DE LA EMPRESA QUE DESPACHA', 1, 1, 'C',true);
	//FILA 4
	$pdf->Cell(85, 5, 'RAZON SOCIAL', 'LRB', 0, 'C');
	$pdf->Cell(25, 5, 'RIF/CI', 'LRB', 0, 'C');
	$pdf->Cell(70, 5, 'PERSONA AUTORIZADA', 'LRB', 1, 'C');
	//FILA 5
	$pdf->letraNormal();
	$pdf->Cell(85, 5, 'JOSE ADRIAN TOVAR INVERSIONES TOVAR', 'LR', 0, 'C');
	$pdf->Cell(25, 5, 'V059416169', 'LR', 0, 'C');
	$pdf->Cell(70, 5, 'JOSE ADRIAN TOVAR', 'LR', 1, 'C');
	//FILA 6
	$pdf->letraNegrita();
	$pdf->Cell(18, 5, 'DIRECCION:', 1, 0, 'C');
	$pdf->letraNormal();
	$pdf->Cell(162, 5, 'URBANIZACION VILLA ARAURE 1,SECTOR LA LAGUNITA, AV. 14 CASA N:6 A 3 CUADRAS DEL LICEO LUIS BELTRAN', 1, 1, 'C');
	//FILA 7
	$pdf->letraNegrita();
	$pdf->Cell(85, 5, 'ESTADO', 'LRB', 0, 'C');
	$pdf->Cell(55, 5, 'CIUDAD', 'LRB', 0, 'C');
	$pdf->Cell(40, 5, 'TELEFONO', 'LRB', 1, 'C');
	//FILA 8
	$pdf->letraNormal();
	$pdf->Cell(85, 5, 'PORTUGUESA', 'LR', 0, 'C');
	$pdf->Cell(55, 5, 'ARAURE', 'LR', 0, 'C');
	$pdf->Cell(40, 5, '0416-0989101', 'LR', 1, 'C');
	//fila 9
	$pdf->letraNegrita();
	$pdf->Cell(85, 7, 'RUBRO', 1, 0, 'C');
	$pdf->Cell(25, 7, 'CANT', 1, 0, 'C');
	$pdf->Cell(70, 7, 'PRESENTACION/OBSERVACION', 1, 1, 'C');
	//obtiene la cantidad de detalles para compararlos

}
	//fila 10
	$pdf->letraNormal();
 while($detalle_fac = $objDetalle->row()){
 	$i++;//contador para mostrar los despresados

	if($detalle_fac['nom_pro'] =='POLLO BENEFICIADO' ){
		$pdf->Cell(85, 7,'Pollo Beneficiado Entero', 1, 0, 'L');
		$pdf->Cell(25, 7, $detalle_fac['can_ven_pro'], 1, 0, 'C');
		$pdf->Cell(70, 7, 'Cestas', 1, 1, 'C');
	}else{
		$cant=$cant+$detalle_fac['can_ven_pro'];
		
	}


/*
	if($facturaPDF['nom_pro'] =='Pollo Beneficiado' ){
		
		$pdf->Cell(85, 7,'Pollo Beneficiado Entero', 1, 0, 'L');
		$pdf->Cell(25, 7, $facturaPDF['can_ven_pro'], 1, 0, 'C');
		$pdf->Cell(70, 7, 'Cestas', 1, 1, 'C');
		
	}else{
		$cant=$cant+$facturaPDF['can_ven_pro'];
		$pdf->Cell(85, 7,'Pollo Despresado', 'RL', 0, 'L');
		$pdf->Cell(25, 7,$cant, 1, 0, 'C');
		$pdf->Cell(70, 7, 'Cestas', 1, 1, 'C');
	}
*/
}
$num_detalle = $objDetalle->rows();
if ($num_detalle==$i) {
		$pdf->Cell(85, 7,'Pollo Despresado', 1, 0, 'L');
		$pdf->Cell(25, 7,$cant, 1, 0, 'C');
		$pdf->Cell(70, 7, 'Cestas', 1, 1, 'C');
	
}

		//FILA 11
		$pdf->letraNegrita();
		$pdf->Cell(180, 5, 'DATOS DE LA EMPRESA QUE RECIBE', 'LRB', 1, 'C',true);
		//FILA 12
		$pdf->Cell(85, 5, 'RAZON SOCIAL', 'LRB', 0, 'C');
		$pdf->Cell(25, 5, 'RIF/CI', 'LRB', 0, 'C');
		$pdf->Cell(70, 5, 'PERSONA AUTORIZADA', 'LRB', 1, 'C');
		//FILA 13
		$pdf->letraNormal();
		$pdf->Cell(85, 5, $facturaPDF['nom_cli'], 'LR', 0, 'L');
		$pdf->Cell(25, 5, $facturaPDF['rif_cli'], 'LR', 0, 'L');
		$pdf->Cell(70, 5, $facturaPDF['pers_cli'], 'LR', 1, 'L');
		//FILA 14
		$pdf->letraNegrita();
		$pdf->Cell(18, 5, 'DIRECCION:', 1, 0, 'C');
		$pdf->letraNormal();
		$pdf->Cell(162, 5, $facturaPDF['dir_cli'], 1, 1, 'L');
		//FILA 15
		$pdf->letraNegrita();
		$pdf->Cell(85, 5, 'ESTADO', 'LRB', 0, 'C');
		$pdf->Cell(55, 5, 'CIUDAD', 'LRB', 0, 'C');
		$pdf->Cell(40, 5, 'TELEFONO', 'LRB', 1, 'C');
		//FILA 16
		$pdf->letraNormal();
		$pdf->Cell(85, 5, $facturaPDF['des_zona'], 'LR', 0, 'C');
		$pdf->Cell(55, 5, $facturaPDF['des_muni'], 'LR', 0, 'C');
		$pdf->Cell(40, 5, $facturaPDF['tlfn_cli'], 'LR', 1, 'C');

	//fila 17
	$pdf->letraNegrita();
	$pdf->Cell(90, 5, 'FACTURAS U ORDENES QUE SORPORTAN EN EL DESPACHO:', 1, 0, 'C',true);
	$pdf->Cell(90, 5, $n, 1, 1, 'L',true);
	//fila 18
	$pdf->Cell(180, 5, 'DATOS DE TRANSPORTE', 1, 1, 'C',true);
	//FILA 19
	$pdf->letraNormal();
	$pdf->Cell(60, 5, 'CI del Chofer: '.$facturaPDF['chofer_fk'], 1, 0, 'L');
	$pdf->Cell(120, 5, 'Nombre y Apellido del Chofer: '.$facturaPDF['nom_chof'], 1, 1, 'L');
	$pdf->Cell(180, 5, 'Placas: '.$facturaPDF['placa_fac'], 1, 1, 'L');

			
}
//FILA 20
$pdf->letraPeq();
$pdf->Cell(180, 4, 'INVERSIONES TOVAR AUTORIZA EXPRESAMENTE AL TITULAR DE ESTA  GUIA DE MOVILIZACION, EL TRASLADO DE LOS RUBROS  DESCRITOS EN LA MISMA,', 'LRT', 1, 'C');
$pdf->Cell(180, 2, 'DESDE EL SITIO DE ORIGEN HASTA SU DESTINO DENTRO DEL AMBITO DEL TERRITORIO NACIONAL, SEGUN LO ESTABLECIDO EN LA RESOLUCION D/M NRO 025-12 DE FECHA', 'LR', 1, 'C');
$pdf->Cell(180, 4, '14 DE JUNIO DE 2012, PUBLICADA EN GACETA NRO 39.949 DE FECHA 21 DE JUNIO DEL 2012. DEBE ANEXAR LA GUIA DE DESPACHO.', 'LR', 1, 'C');
//FILA 20
$pdf->SetFont('Arial','B',6);
$pdf->Cell(180, 4, 'NOTA: DE ESTEFORMATO O GUIA EXISTE UNA (01) COPIA BENEFICIARIO Y UNA (01 COPIA TRANSPORTE. DEBE SER LLEVADA Y FIRMADA EN LAS ALCABALAS DURANTE)', 'LRT', 1, 'L');
$pdf->Cell(180, 4, 'EL TRANSITO LOS DATOS DE ORIGEN Y DESTINO DEBEN CORESPONDER CON LOS DATOS DE LA FACTURA O NOTA DE ENTREGA.', 'LRB', 1, 'L');

$pdf->ln(30);
$pdf->Cell(0, 6, '_________________________________________', 0, 1, 'C');

$pdf->ln(6);
$pdf->letraPeq();
$pdf->Cell(0, 4, 'Estado Portuguesa Municipio Araure Av. 14 - Casa N°: 06 - Urb. Villa Araure I', 0, 1, 'C');
$pdf->Cell(0, 4, 'Telefonos: 0255-615.37.58-0416-152.19.00 correo electronico: inversionestovarjose@gmail.com', 0, 1, 'C');








$pdf->Output();
//$pdf->Output("Contrato_".$per_Rut."-".$per_DV.".pdf","D");



?>
