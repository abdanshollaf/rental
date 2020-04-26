<?php
/**
 * Created by PhpStorm.
 * User: ojiepermana
 * Date: 12/24/2016
 * Time: 3:22 PM
 */

namespace App\Helpers;
use Elibyy\TCPDF\Facades\TCPDF;

class Out_pdf
{
    Public static function printpdf($data,$html)
    {
        $pdf = new TCPDF();

        $pdf::SetAuthor('Derazona');
        $pdf::SetTitle($data->title);
        $pdf::SetSubject($data->sub_title);
        $pdf::SetKeywords('TCPDF, PDF, example, test, guide');

		
        $pdf::SetMargins(15, 50, 15, 15);
        $pdf::SetFontSubsetting(false);
        //$pdf::SetFontSize(10);
        $pdf::SetAutoPageBreak(TRUE, 20);
		// $pdf::SetAutoPageBreak(TRUE, 0);
		// $pageLayout = array(241.3, 140);
        $pdf::AddPage($data->kertas, $data->pagelayout);
	    // $pdf::AddPage('P','A4');

        //$pdf::ln(-5);


        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::lastPage();
        $pdf::Output($data->name_file.'.pdf', 'I');
        exit;
    }
    
	Public static function pelanggan($data,$html,$header)
    {
        $pdf = new TCPDF();

        $pdf::SetAuthor('Derazona');
        $pdf::SetTitle($data->title);
        $pdf::SetSubject($data->sub_title);
        $pdf::SetKeywords('TCPDF, PDF, example, test, guide');

        $pdf::setHeaderCallback(function($pdf) use ($header){
            $pdf->writeHTML($header, true, false, true, false, '');
        });

        $pdf::setFooterCallback(function($pdf){

        });
		
		$pdf::setHeaderMargin(15);
        $pdf::SetMargins(15, 50, 15, 15);
        $pdf::SetFontSubsetting(false);
        //$pdf::SetFontSize(10);
        $pdf::SetAutoPageBreak(TRUE, 20);
		// $pdf::SetAutoPageBreak(TRUE, 0);
		// $pageLayout = array(241.3, 140);
        $pdf::AddPage($data->kertas, $data->pagelayout);
	    // $pdf::AddPage('P','A4');

        //$pdf::ln(-5);


        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::lastPage();
        $pdf::Output($data->name_file.'.pdf', 'I');
        exit;
    }
    Public static function faktur($data,$html) // login
    {

        $pdf = new TCPDF();

        $pdf::SetAuthor('Derazona');
        $pdf::SetTitle($data->title);
        $pdf::SetSubject($data->sub_title);
        $pdf::SetKeywords('TCPDF, PDF, example, test, guide');	



        $pdf::setHeaderCallback(function($pdf) use ($data) {

            //$pdf->Ln(5);
            // Set font
            //$pdf->SetFont('helvetica', 'B', 14);
            // Move to the right
            //$pdf->Cell(80);
            //$pdf->Ln(-2);
            // Title
	    //$pdf->Image(public_path('logo_pdam.jpg'), 85, 4, 35, 15);
	    $pdf->Image(public_path('logo_pdam.jpg'),$data->xdirection2,$data->ydirection2,$data->hdirection2,$data->wdirection2);
            $pdf->Image(public_path('logo_pdam.jpg'),$data->xdirection1,$data->ydirection1,$data->hdirection1,$data->wdirection1);

            // Line break
            //$pdf->Ln(1);
            //$pdf->SetFont('helvetica', 'B', 14);

        });
	

        $pdf::setFooterCallback(function($pdf) {

            // Position at 15 mm from bottom
            //$pdf->SetY(-10);
            // Set font
            //$pdf->SetFont('helvetica', 'I', 8);
            // Page number
            // $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
            //$pdf->Ln(-2);
            // $pdf->Cell(0, 10, 'Date Print :' . date('Y-m-d'), 0, 0, 'L');
        });

		$pdf::SetMargins($data->margin1, $data->margin2, $data->margin3, $data->margin4);
        //$pdf::SetMargins(20, 5, 20, 5);
        $pdf::SetFontSubsetting(false);
        //$pdf::SetFontSize(10);
        //$pdf::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf::SetAutoPageBreak(TRUE, 0);
		$pageLayout = array(241.3, 140);
        //$pdf::AddPage($data->kertas, $pageLayout);
	$pdf::AddPage($data->kertas, $data->pagelayout);

        //$pdf::ln(-5);


        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::lastPage();
        $pdf::Output($data->name_file.'.pdf', 'I');
        exit;
    }


}