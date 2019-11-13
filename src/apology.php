<?php

$html = '
<!DOCTYPE html>
<html lang="DE">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <style>
        .underline {
            text-decoration: underline;
        }

        .alignRight {
            float: right;
        }
    </style>
</head>
<body>
<?php
    include "config.php";
?>
<p>
<span class="underline">Vorname Nachname - Straße 1 - 12345 Stadt</span><br>
Akademi<br>
Stra0e<br>
65432 Stadt<br>
<span class="alignRight">Stadt, 14.10.2019</span>
</p>

<br><br><br><br><br>

<p>
<strong>Entschuldigung für Abwesenheit</strong><br>
14.10.19 | Von 11.45 Uhr bis 11:50 Uhr abwesend | 5 Minuten verpasst
</p>

<br><br><br><br>

<p>
Sehr geehrter Herr Mustermann,<br><br>
hiermit entschuldige ich mich für Montag, den 14.10.2019. Ich habe mich verspätet. / Ich bin früher gegangen. / Ich bin später gekommen. Ich war zwischen 11:45 Uhr und 11:50 Uhr abwesend und habe dadurch 5 Minuten vom Unterricht verpasst.<br><br>
Grund: Ich habe die Zeit vergessen. / Ich hatte Bauchschmerzen. / Ich hatte private Gründe.
</p>

<br><br>

Mit freundlichen Grüßen

<br><br><br>

Max Mustermann

</body>
</html>';
 
//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


    // Create PDF document
    // Load library
    require_once('ext/TCPDF/tcpdf.php');

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
    // Document informations
    $pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($_GET['fullname']);//$inv -> pdfAuthor);
$pdf->SetTitle("Entschuldigung");//$inv -> getInvoiceName());
$pdf->SetSubject("Endschuldigung");//$inv -> getInvoiceName());
 
 
// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// Schriftart
$pdf->SetFont('dejavusans', '', 10);
 
// Neue Seite
$pdf->AddPage();
 
// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
$pdf->Output($pdfName, 'I');
 
//Variante 2: PDF im Verzeichnis abspeichern:
//$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
//echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';
?>
