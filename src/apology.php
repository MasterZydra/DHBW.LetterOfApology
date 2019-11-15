<?php
    // Erstellt von 6439456
    
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
        $day = DateTime::createFromFormat('Y-m-d', $day);
        // Set to German
        setlocale(LC_TIME, "de_DE");
        // Return day name
        return $day->format('l');
    }
    
    /*
     * Format the date to German format
     */
    function formatDate($date) {
        // Get DateTime from String
        $day = DateTime::createFromFormat('Y-m-d', $date);
        // Add date to file name
        return $day->format('d.m.Y');
    }
    
    /*
     * Generate file name from given date and type
     */
    function getFileName($date) {
        // Add date to file name
        $file = formatDate($date) . " Entschuldigung ";
        // Add type of apology
        if (getMaskedGet('type') == "minutes") {
            $file .= "Minuten";
        } else if (getMaskedGet('type') == "days") {
            $file .= "Tage";
        }
        // Return file name with extension
        return $file  . '.pdf';
    }
    
    /*
     * Convert special characters to HTML entities
     * to prevent Cross Site Scripting (XSS)
     */
    function getMaskedGet($name) {
        return htmlspecialchars($_GET[$name]);
    }
    
    
    // Arrays with necessary parameters
    $primaryParams = [
        "type", "firstname", "lastname",
        "street", "postalCode", "city",
        "explanation", "absenceDate"];
    $minutesParams = [
        "time_from", "time_to", "typeOfDelay"];
    $daysParams = [
        "missingDays"];
    
    // Check if primary data are given
    checkParameters($primaryParams);
    
    // Build full name for easier use
    $fullname = getMaskedGet('firstname') . ' ' . getMaskedGet('lastname');
    // Get file name for PDF document
    $pdfName = getFileName(getMaskedGet('absenceDate'));
    
    // Get data from receiver
    include "config.php";
    
    
    // Set header for every document
    // Important: No indentation in the contents,
    // as these cause indentations in the output
    // ---- Header Start ---->
    $header = '
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
. $fullname . ' - '
. getMaskedGet('street') . ' - '
. getMaskedGet('postalCode') . ' ' . getMaskedGet('city')
. '</span><br>
' . $config['receiver_name'] . '<br>
' . $config['receiver_street'] . '<br>
' . $config['receiver_postalCode'] . ' ' . $config['receiver_city'] . '<br>
<table cellpadding="0" cellspacing="0" style="width: 100%;">
    <tr>
        <td width="75%"></td>
        <td>' . $config['receiver_city'] . ', ' . formatDate(getMaskedGet('absenceDate')) . '</td>
    </tr>
</table>
</p>
    
<p></p>

<p>
<strong>Entschuldigung für Abwesenheit</strong><br>';
    // <---- Header End ----
    
    
    // Footer for every document
    // Important: No indentation in the contents,
    // as these cause indentations in the output
    // ---- Footer Start ---->
    $footer = '
<p>
Grund: ' . getMaskedGet('explanation') . '
</p>

<p></p>

Mit freundlichen Grüßen

<p></p>
'
. $fullname . '
</body>
</html>';
    // <---- Footer End ----

    
    if (getMaskedGet('type') == "minutes") {
        // Check if minute data are given
        checkParameters($minutesParams);
        
        // Important: No indentation in the contents,
        // as these cause indentations in the output
        $content =
formatDate(getMaskedGet('absenceDate')) . ' | Von ' . formatTime(getMaskedGet('time_from'))
. ' Uhr bis ' . formatTime(getMaskedGet('time_to')) . ' Uhr abwesend | '
. timeDif(getMaskedGet('time_from'), getMaskedGet('time_to'))
. ' Minuten verpasst
</p>

<p></p>

<p>
' . $config['salutation'] . ',<br><br>
hiermit entschuldige ich mich für <strong>'
. getDayName(getMaskedGet('absenceDate')) . ', den '
. formatDate(getMaskedGet('absenceDate')) . '</strong>. ' . $_GET['typeOfDelay']
. '. Ich war zwischen <strong>' . formatTime(getMaskedGet('time_from'))
. ' und ' . formatTime(getMaskedGet('time_to'))
. ' Uhr abwesend</strong> und habe dadurch <strong>'
. timeDif(getMaskedGet('time_from'), getMaskedGet('time_to'))
. ' Minuten</strong> vom Unterricht verpasst.
</p>';
    }
    else if (getMaskedGet('type') == "days") {
        // Check if minute data are given
        checkParameters($daysParams);
        // Important: No indentation in the contents,
        // as these cause indentations in the output
        $content =
formatDate(getMaskedGet('absenceDate')) . ' | ' . getMaskedGet('missingDays') . ' Tag verpasst
</p>

<p></p>

<p>
' . $config['salutation'] . ',<br><br>
hiermit entschuldige ich mich für <strong>'
. getDayName(getMaskedGet('absenceDate')) . ', den '
. formatDate(getMaskedGet('absenceDate')) . '</strong>. Ich war an diesem Tag <strong>abwesend</strong>.
</p>';
    }
    
    // PDF generation
    // ---------------------------------------------------
 
    // Create PDF document
    // Load library
    require_once('ext/TCPDF/tcpdf.php');

    // Create new TCPDF object
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
    // Document informations
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor($fullname);
    $pdf->SetTitle("Entschuldigung");
    $pdf->SetSubject("Endschuldigung");
 
    // Deactivate Header und Footer
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    // Use monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
    // Set Margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
 
    // Set font and font size
    $pdf->SetFont('dejavusans', '', 11);
 
    // Add new page
    $pdf->AddPage();
 
    // Add HTML code to page and generate PDF out of it
    $pdf->writeHTML($header . $content . $footer, true, false, true, false, '');
 
    // --- Save PDF for admin ---
    // Switch last and firstname for folder name
    $fullname =  getMaskedGet('lastname') . ' ' . getMaskedGet('firstname');
    $filePath = './admin/PDFs/' . $fullname;
    // Check if permissions for PDF directory are correctly set.
    // Directory needs to be writeable for PHP.
    if (!is_writable('./admin/PDFs/')) {
        # Show message for user to inform admin.
        echo "PHP kann keinen Ordner anlegen oder PDF im Verzeichnis ablegen.<br>";
        echo "Bitte informieren Sie Ihren Administrator.";
        return;
    }
    // Check if directory for user exists
    if (!is_dir($filePath)) {
        // Create a new directory for user
        mkdir($filePath, 0777, true);
    }
    // Write file to file system. Overwrite file with old name if necessary.
    $pdf->Output(dirname(__FILE__). '/admin/PDFs/' . $fullname . '/' . $pdfName, 'F');
    
    // Show PDF to user in browser window
    $pdf->Output($pdfName, 'I');
?>
