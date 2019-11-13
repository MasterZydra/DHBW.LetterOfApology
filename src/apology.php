<?php
    /*
     * Check if all names are found in the URL as GET.
     * If not, go to start page
     */
    function checkParameters($names) {
        foreach($names as $name) {
            // Jump to start page if a relevant data is missing
            if (!isset($_GET[$name])) {
                header("Location: index.php");
                exit();
            }
        }
    }
    
    /*
     * Format output of time.
     * Add leading zero to time if necessary.
     */
    function formatTime($time) {
        // e.g.  1:00 --> len = 4
        // e.g. 10:00 --> len = 5
        if (strlen($time) == 4) {
            // Add leading zero
            return "0" . $time;
        }
        // Else return
        return $time;
    }
    
    /*
     * Calculate time difference between to given time stamps
     */
    function timeDif($time1, $time2) {
        // Convert string to DateTime
        $from = DateTime::createFromFormat('H:i', $time1);
        $to = DateTime::createFromFormat('H:i', $time2);
        // Calc dif and get dif in minutes
        return abs($to->getTimestamp() - $from->getTimestamp()) / 60;
    }
    
    /*
     * Return day name of a given day.
     */
    function getDayName($day) {
        // Get DateTime from String
        $day = DateTime::createFromFormat('d.m.Y', $day);
        // Set to German
        setlocale(LC_TIME, "de_DE");
        // Return day name
        return $day->format('l');
    }
    
    // Arrays with necessary parameters
    $primaryParams = array("type", "fullname", "street", "postalCode", "city", "explanation");
    $minutesParams = array("absenceDate", "time_from", "time_to", "typeOfDelay");
    
    // Check if primary data are given
    checkParameters($primaryParams);
    
    // Get data from receiver
    include "config.php";

    if ($_GET["type"] == "minutes") {
        // Check if minute data are given
        checkParameters($minutesParams);
        // Important: No indentation in the contents, as these cause indentations in the output
        $content = '
<!DOCTYPE html>
<html lang="DE">
<head>
    <meta charset="UTF-8">
    <title>Entschuldigung für Abwesenheit</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .underline {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<p>
<span class="underline">'
    . $_GET['fullname'] . ' - ' . $_GET['street'] . ' - ' . $_GET['postalCode'] . ' ' . $_GET['city'] . '</span><br>
' . $config['receiver_name'] . '<br>
' . $config['receiver_street'] . '<br>
' . $config['receiver_postalCode'] . ' ' . $config['receiver_city'] . '<br>
<table cellpadding="0" cellspacing="0" style="width: 100%; ">
    <tr>
        <td width="75%"></td>
        <td>' . $config['receiver_city'] . ', ' . $_GET['absenceDate'] . '</td>
    </tr>
</table>
</p>
    
<p></p>

<p>
<strong>Entschuldigung für Abwesenheit</strong><br>
' . $_GET['absenceDate'] . ' | Von ' . formatTime($_GET['time_from']) . ' Uhr bis ' . formatTime($_GET['time_to']) . ' Uhr abwesend | ' . timeDif($_GET['time_from'], $_GET['time_to']) . ' Minuten verpasst
</p>

<p></p>
/// --> Wochentag
<p>
' . $config['salutation'] . ',<br><br>
hiermit entschuldige ich mich für <strong>' . getDayName($_GET['absenceDate']) . ', den ' . $_GET['absenceDate'] . '</strong>. ' . $_GET['typeOfDelay'] . '. Ich war zwischen <strong>' . formatTime($_GET['time_from']) . ' und ' . formatTime($_GET['time_to']) . ' Uhr abwesend</strong> und habe dadurch <strong>' . timeDif($_GET['time_from'], $_GET['time_to']) . ' Minuten</strong> vom Unterricht verpasst.<br><br>
Grund: ' . htmlspecialchars ($_GET['explanation']) . '
</p>

<p></p>

Mit freundlichen Grüßen

<p></p>
'
. $_GET['fullname'] . '
</body>
</html>';
    } else if ($_GET["type"] == "days") {
        // TODO: --> Check für Tage
    }
 
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
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage();
 
// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($content, true, false, true, false, '');
 
//Ausgabe der PDF
 
//Variante 1: PDF direkt an den Benutzer senden:
$pdf->Output($pdfName, 'I');
 
//Variante 2: PDF im Verzeichnis abspeichern:
//$pdf->Output(dirname(__FILE__).'/'.$pdfName, 'F');
//echo 'PDF herunterladen: <a href="'.$pdfName.'">'.$pdfName.'</a>';
?>
