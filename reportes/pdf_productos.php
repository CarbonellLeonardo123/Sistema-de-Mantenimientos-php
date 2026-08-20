<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
require('../fpdf/fpdf.php');
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$resultado = mysqli_query($conn, "SELECT * FROM producto ORDER BY nombre");

$pdf = new FPDF('L');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,12,'REPORTE DE PRODUCTOS - PROMART',0,1,'C',true);
$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,123,32);
$pdf->Cell(10,8,'ID',1,0,'C',true);
$pdf->Cell(80,8,'NOMBRE',1,0,'C',true);
$pdf->Cell(60,8,'CATEGORIA',1,0,'C',true);
$pdf->Cell(30,8,'STOCK',1,0,'C',true);
$pdf->Cell(40,8,'PRECIO (S/.)',1,0,'C',true);
$pdf->Cell(40,8,'ESTADO STOCK',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$fill = false;
while($fila = mysqli_fetch_array($resultado)){
    $estado = $fila['stock'] > 10 ? 'Disponible' : ($fila['stock'] > 0 ? 'Stock Bajo' : 'Agotado');
    $pdf->SetFillColor($fill ? 230 : 255, $fill ? 240 : 255, $fill ? 255 : 255);
    $pdf->Cell(10,7,$fila['idProducto'],1,0,'C',$fill);
    $pdf->Cell(80,7,$fila['nombre'],1,0,'L',$fill);
    $pdf->Cell(60,7,$fila['categoria'],1,0,'L',$fill);
    $pdf->Cell(30,7,$fila['stock'],1,0,'C',$fill);
    $pdf->Cell(40,7,'S/. '.number_format($fila['precio'],2),1,0,'R',$fill);
    $pdf->Cell(40,7,$estado,1,1,'C',$fill);
    $fill = !$fill;
}
$pdf->Ln(6);
$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(100,100,100);
$pdf->Cell(0,6,'Generado el '.date('d/m/Y H:i').' por '.$_SESSION['usuario'],0,1,'R');
$pdf->Output('I','Reporte_Productos.pdf');