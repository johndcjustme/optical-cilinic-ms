<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Dompdf\Dompdf;
use PDF;

trait File {

    public function downloadPDF_Frame($filename = 'Downloaded Frames')
    {
        date_default_timezone_set("Asia/Manila");

        $today = date('Y-m-d');

        $new_filename = "{$filename} {$today}.pdf";
        
        // return $this->savePdf($filename);
        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->frame_html());
            echo $pdf->stream();
        }, $new_filename);
    }

    public function downloadPDF_Lens($filename = 'Downloaded Lenses')
    {
        date_default_timezone_set("Asia/Manila");

        $today = date('Y-m-d');

        $new_filename = "{$filename} {$today}.pdf";
        
        // return $this->savePdf($filename);
        return response()->streamDownload(function () {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($this->lens_html());
            echo $pdf->stream();
        }, $new_filename);
    }
}