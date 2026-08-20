<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
require('../fpdf/fpdf.php');
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT c.idCompra, p.nombre as proveedor, c.fecha, c.total
        FROM compras c LEFT JOIN proveedor p ON c.idProveedor=p.idProveedor
        ORDER BY c.fecha DESC";
$resultado = mysqli_query($conn, $sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,12,'REPORTE DE COMPRAS - PROMART',0,1,'C',true);
$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,123,32);
$pdf->Cell(15,8,'ID',1,0,'C',true);
$pdf->Cell(80,8,'PROVEEDOR',1,0,'C',true);
$pdf->Cell(40,8,'FECHA',1,0,'C',true);
$pdf->Cell(55,8,'TOTAL (S/.)',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$fill = false;
$totalGeneral = 0;
while($fila = mysqli_fetch_array($resultado)){
    $pdf->SetFillColor($fill ? 230 : 255, $fill ? 240 : 255, $fill ? 255 : 255);
    $pdf->Cell(15,7,$fila['idCompra'],1,0,'C',$fill);
    $pdf->Cell(80,7,$fila['proveedor'],1,0,'L',$fill);
    $pdf->Cell(40,7,date('d/m/Y',strtotime($fila['fecha'])),1,0,'C',$fill);
    $pdf->Cell(55,7,'S/. '.number_format($fila['total'],2),1,1,'R',$fill);
    $totalGeneral += $fila['total'];
    $fill = !$fill;
}
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(135,8,'TOTAL GENERAL',1,0,'R',true);
$pdf->Cell(55,8,'S/. '.number_format($totalGeneral,2),1,1,'R',true);
$pdf->Ln(6);
$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(100,100,100);
$pdf->Cell(0,6,'Generado el '.date('d/m/Y H:i').' por '.$_SESSION['usuario'],0,1,'R');
$pdf->Output('I','Reporte_Compras.pdf');