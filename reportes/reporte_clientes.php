<?php
require('../modelo/clsCliente.php');
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
//buscar a los clientes
//se crea el Objeto Cliente de la clase Cliente
	$objCliente = new clsCliente();
//--------------------------------------------------------------------
//       Funcion para listar los clientes
//--------------------------------------------------------------------
	$objCliente->listar();


//DELCARACION DE LA HOJA
$pdf=new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();

// Cabecera de página


//DATOS DEL TITULO
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont("Arial", "b", 10);
$pdf->Cell(0, 5, 'LISTA DE CLIENTES ', 0, 1, 'C');



//MOSTRAMOS LA TABLA
$pdf->Ln();
$pdf->Cell(25, 7, "Rif Cliente",1,0, 'L');
$pdf->Cell(42, 7, "Nombre cliente",1,0, 'L');
$pdf->Cell(33, 7, "Telefono Cliente",1,0, 'L');
$pdf->Cell(70, 7, "Direccion cliente",1,1, 'L');




$pdf->SetFont("Arial", "", 10);
while($listacli = $objCliente->row())
{
	$pdf->Cell(25, 7, $listacli['rif_cli'],1,0, 'L');
	$pdf->Cell(42, 7, $listacli['nom_cli'],1,0, 'L');
	$pdf->Cell(33, 7, $listacli['tlfn_cli'],1,0, 'L');
	$pdf->Cell(70, 7, $listacli['dir_cli'],1,1, 'L');
	
}




$pdf->Output();
//$pdf->Output("Contrato_".$per_Rut."-".$per_DV.".pdf","D");



?>
