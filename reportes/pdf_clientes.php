<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
require('../fpdf/fpdf.php');
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$resultado = mysqli_query($conn, "SELECT * FROM cliente ORDER BY nombre");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,12,'REPORTE DE CLIENTES - PROMART',0,1,'C',true);
$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,123,32);
$pdf->Cell(10,8,'ID',1,0,'C',true);
$pdf->Cell(45,8,'NOMBRE',1,0,'C',true);
$pdf->Cell(45,8,'APELLIDO',1,0,'C',true);
$pdf->Cell(60,8,'CORREO',1,0,'C',true);
$pdf->Cell(30,8,'DNI',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($fila = mysqli_fetch_array($resultado)){
    $pdf->SetFillColor($fill ? 230 : 255, $fill ? 240 : 255, $fill ? 255 : 255);
    $pdf->Cell(10,7,$fila['idCliente'],1,0,'C',$fill);
    $pdf->Cell(45,7,$fila['nombre'],1,0,'L',$fill);
    $pdf->Cell(45,7,$fila['apellido'],1,0,'L',$fill);
    $pdf->Cell(60,7,$fila['correo'],1,0,'L',$fill);
    $pdf->Cell(30,7,$fila['dni'],1,1,'C',$fill);
    $fill = !$fill;
}
$pdf->Ln(6);
$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(100,100,100);
$pdf->Cell(0,6,'Generado el '.date('d/m/Y H:i').' por '.$_SESSION['usuario'],0,1,'R');
$pdf->Output('I','Reporte_Clientes.pdf');