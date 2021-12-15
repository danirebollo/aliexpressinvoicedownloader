<?php
//https://www.pdfparser.org/documentation
//https://github.com/smalot/pdfparser

include 'vendor/autoload.php';

$directory = "oldinvoices";
$newdirectory = "newinvoices";
$vendor = "aliexpress";
$vat = 21;

function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

$invoices = scandir($directory);

foreach ($invoices as $invoice) {
    if ($invoice == "." || $invoice == "..") {
        continue;
    }
    $parser = new \Smalot\PdfParser\Parser();
    $file = $invoice;
    $pdf    = $parser->parseFile($directory . "/" . $file);

    $text = $pdf->getText();

    $details  = $pdf->getDetails();
    $rawdata = $pdf->getObjects();

    $fullstring = $text;
    $parsed2 = explode("\n", $text);

    foreach ($parsed2 as $valor) {
        if (0){//(startsWith($valor, "Total")) {
            $parsed3 = explode("\t", $valor);
            echo print_r($parsed3 ,1);
            $import = $parsed3[1]+$parsed3[2];
        } else if (startsWith($valor, "Invoice Date :")) {
            $parsed3 = str_replace("Invoice Date :", "", $valor);
            $date = $parsed3;
        }
        else if (startsWith($valor, "Amount paid")) {
            $parsed3 = explode("\t", $valor);
            $import = $parsed3[2];
        } 
        
    }

    $invnumber = explode(".", $file);
    $extension = $invnumber[1];
    $invnumber = explode("_", $invnumber[0]);
    $invnumber = $invnumber[0];

    $date = str_replace("-", "", $date);
    $filename = $date . "_" . ($import * 100) . "_" . $vat . "_" . $vendor . "_" . $invnumber . ".pdf";
    echo "-processing file: $file. filename: $filename<br>";
    rename($directory . "/" . $file, $newdirectory . "/" . $filename);
}
