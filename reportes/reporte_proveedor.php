<?php
require('../modelo/clsProveedor.php');
require "fpdf.php";



class PDF extends FPDF
{

function Header()
		{
			//Logo
			$this->Image('../imagenes/logo.jpg',60,8,100,20);
			$this->Ln(24);			
		}
}
//buscar a los Proveedors
//se crea el Objeto Proveedor de la clase Proveedor
	$objProveedor = new clsProveedor();
//--------------------------------------------------------------------
//       Funcion para listar los Proveedors
//--------------------------------------------------------------------
	$objProveedor->listar();


//DELCARACION DE LA HOJA
$pdf=new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de página


//DATOS DEL TITULO
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont("Arial", "b", 7);
$pdf->Cell(0, 5, 'LISTA DE PROVEEDORES ', 0, 1, 'C');



//MOSTRAMOS LA TABLA
$pdf->Ln();
$pdf->Cell(20, 7, "Rif Proveedor",1,0, 'L');
$pdf->Cell(50, 7, "Nombre Proveedor",1,0, 'L');
$pdf->Cell(25, 7, "Telefono Proveedor",1,0, 'L');
$pdf->Cell(80, 7, "Direccion Proveedor",1,1, 'L');




$pdf->SetFont("Arial", "", 7);
while($listapro = $objProveedor->row())
{
	$pdf->Cell(20, 7, $listapro['rif_prov'],1,0, 'L');
	$pdf->Cell(50, 7, $listapro['nom_prov'],1,0, 'L');
	$pdf->Cell(25, 7, $listapro['tlfn_prov'],1,0, 'L');
	$pdf->Cell(80, 7, $listapro['dir_prov'],1,1, 'L');
	
}




$pdf->Output();
//$pdf->Output("Contrato_".$per_Rut."-".$per_DV.".pdf","D");



?>
