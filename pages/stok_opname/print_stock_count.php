<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../tcpdf/tcpdf.php';
require_once __DIR__ . '/../../pdf_config.php';

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
setPDFMeta($pdf);

class MYPDF extends TCPDF
{
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C');
    }
}
$pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);
setPDFMeta($pdf);

$pdf->AddPage();
ob_start();
include __DIR__ . '/../../pages/stok_opname/konten_cetak/stock_count.php';
$html = ob_get_clean();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Print-stock-count.pdf', 'I');
