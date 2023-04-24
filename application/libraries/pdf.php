<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once('vendor/autoload.php');

class Pdf
{
    function createPDF($html, $filename = '', $download = TRUE, $paper = 'A4', $orientation = 'landscape')
    {
        $dompdf = new Dompdf\DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($download)
            $dompdf->stream($filename . '.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename . '.pdf', array('Attachment' => 0));
    }
}
