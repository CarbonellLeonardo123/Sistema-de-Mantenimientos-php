<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("Location:../index.php"); exit(); }
require('../fpdf/fpdf.php');
include($_SERVER['DOCUMENT_ROOT'].'/Promart/config/conexion.php');
/** @var mysqli $conn */
$sql = "SELECT v.idVenta, c.nombre, c.apellido, v.fecha, v.total
        FROM venta v LEFT JOIN cliente c ON v.idCliente=c.idCliente
        ORDER BY v.fecha DESC";
$resultado = mysqli_query($conn, $sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0,12,'REPORTE DE VENTAS - PROMART',0,1,'C',true);
$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,123,32);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(15,8,'ID',1,0,'C',true);
$pdf->Cell(70,8,'CLIENTE',1,0,'C',true);
$pdf->Cell(35,8,'FECHA',1,0,'C',true);
$pdf->Cell(40,8,'TOTAL (S/.)',1,0,'C',true);
$pdf->Cell(30,8,'ESTADO',1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);
$fill = false;
$totalGeneral = 0;
while($fila = mysqli_fetch_array($resultado)){
    $pdf->SetFillColor($fill ? 230 : 255, $fill ? 240 : 255, $fill ? 255 : 255);
    $pdf->Cell(15,7,$fila['idVenta'],1,0,'C',$fill);
    $pdf->Cell(70,7,$fila['nombre'].' '.$fila['apellido'],1,0,'L',$fill);
    $pdf->Cell(35,7,date('d/m/Y',strtotime($fila['fecha'])),1,0,'C',$fill);
    $pdf->Cell(40,7,'S/. '.number_format($fila['total'],2),1,0,'R',$fill);
    $pdf->Cell(30,7,'Completado',1,1,'C',$fill);
    $totalGeneral += $fila['total'];
    $fill = !$fill;
}
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(30,58,95);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(120,8,'TOTAL GENERAL',1,0,'R',true);
$pdf->Cell(40,8,'S/. '.number_format($totalGeneral,2),1,0,'R',true);
$pdf->Cell(30,8,'',1,1,'C',true);

$pdf->Ln(6);
$pdf->SetFont('Arial','I',8);
$pdf->SetTextColor(100,100,100);
$pdf->Cell(0,6,'Generado el '.date('d/m/Y H:i').' por '.$_SESSION['usuario'],0,1,'R');

$pdf->Output('I','Reporte_Ventas.pdf');