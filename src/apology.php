<?php

  // Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.
 /*
$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
    <tr>
        <td width="60%">' . nl2br(trim($inv -> invoiceSender)) . '</td>
        <td width="25%">
Rechnungsnummer:<br>
Rechnungsdatum:
         </td>
        <td width="15%" style="text-align: right;">
' . $inv -> invoiceNr . '<br>
' . $inv -> invoiceDate . '
         </td>
     </tr>
     <tr>
        <td style="font-size:1.3em; font-weight: bold;">
            <br><br>
Rechnung
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2">' . nl2br(trim($inv -> invoiceReceiver)) . '</td>
    </tr>
</table>
<br><br><br>
 
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
    <tr style="background-color: #4a8a16; padding:5px; color:white;">
        <td style="padding:5px;">
            <b>Lieferschein-Nr</b>
        </td>
        <td style="text-align: center;">
            <b>Lieferdatum</b>
        </td>
        <td style="text-align: center;">
            <b>Menge</b>
        </td>
        <td style="text-align: center;">
            <b>Preis</b>
        </td>
    </tr>';

// Add items
$totalAmount = 0;
foreach($invoiceItems as $item) {
    // Calculate price
    $price = $item[3] * $item[2];
    $totalAmount += $price;
    $html .= '
        <tr>
            <td style="text-align: center;">' . $item[0].  '</td>
            <td style="text-align: center;">' . $item[1] . '</td>
            <td style="text-align: right;">' . $item[2] . ' ' . $inv -> volumeUnit . '</td>
            <td style="text-align: center;">' . number_format($price, 2, ',', '') . ' Euro</td>
        </tr>';
}
$html .="</table>";

$html .= '
<hr>
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">';
if($umsatzsteuer > 0) {
 $netto = $totalAmount / (1+$umsatzsteuer);
 $umsatzsteuer_betrag = $totalAmount - $netto;
 
 $html .= '
 <tr>
 <td colspan="3">Zwischensumme (Netto)</td>
 <td style="text-align: center;">'.number_format($netto , 2, ',', '').' Euro</td>
 </tr>
 <tr>
 <td colspan="3">Umsatzsteuer ('.intval($umsatzsteuer*100).'%)</td>
 <td style="text-align: center;">'.number_format($umsatzsteuer_betrag, 2, ',', '').' Euro</td>
 </tr>';
}
 
$html .='
            <tr>
                <td colspan="3"><b>Gesamtbetrag: </b></td>
                <td style="text-align: center;"><b>'.number_format($totalAmount, 2, ',', '').' Euro</b></td>
            </tr> 
        </table>
<br><br><br>';
/*
if(isset($comment) {
 $html .= $comment;
}*/
/*
// Bankverbindung
$html .= "<strong>Bankverbindung</strong>:"
. "<br>" . $inv -> bankDetails_name
. "<br>IBAN: " . $inv -> bankDetails_IBAN
. "<br>BIC: " . $inv -> bankDetails_BIC;
 
 */

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
