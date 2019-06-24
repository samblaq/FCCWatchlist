<?php
    include('databaseconnection.php');
    include('session.php');
    require('fpdf.php');

    class PDF extends FPDF{
        
        function header(){
            include('session.php');
            date_default_timezone_set('UTC');
            $this->image('assets/img/logo.png',10,6);
            $created_at = date("F j, Y, g:i a");
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'SCB FCC INTERNAL WATCHLIST',0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276,10,$created_at,0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276,10,'printed by: '. $Employee_ID,0,0,'C');
            $this->Ln(40);
        }
 
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    
        function headerTable(){
            $this->SetFont('Times','B',12);
            $this->Cell(40,10,'Date of Notice',1,0,'C');
            $this->Cell(40,10,'Reference Number',1,0,'C');
            $this->Cell(40,10,'Individual/Entity',1,0,'C');
            $this->Cell(30,10,'LinkedTo',1,0,'C');
            $this->Cell(30,10,'Subject Name',1,0,'C');
            $this->Cell(30,10,'Alias',1,0,'C');
            $this->Cell(22,10,'Country',1,0,'C');
            $this->Cell(32,10,'Further Info',1,0,'C');
            $this->Ln();
        }
         


        
        function viewTable(){
            include('databaseconnection.php');
            $this->SetFont('Times','',12);
            $sql_pdf = "SELECT * FROM Watchlist";
            $result = sqlsrv_query($conn,$sql_pdf);
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                $this->Cell(40,10,$row['DateOfNotice'],1,0,'C');
                $this->Cell(40,10,$row['Regulator'],1,0,'L');
                $this->Cell(40,10,$row['IndividualEntity'],1,0,'L');
                $this->Cell(30,10,$row['LinkedTo'],1,0,'L');
                $this->Cell(30,10,$row['SubjectName'],1,0,'L');
                $this->Cell(30,10,$row['Alias'],1,0,'L');
                $this->Cell(22,10,$row['Country'],1,0,'R');
                $this->Cell(32,10,$row['FurtherInfo'],1,0,'R');
                $this->Ln();
            }
        }

    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();

?>