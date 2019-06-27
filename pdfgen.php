<?php
     include('databaseconnection.php');
     include('session.php');
     require('fpdf.php');
    global $data;
     $data = json_decode($_POST["filtered"], true);
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
             $this->Cell(20,10,'Reg',1,0,'C');
             $this->Cell(30,10,'RefNo.',1,0,'C');
             $this->Cell(25,10,'I/E',1,0,'C');
             $this->Cell(40,10,'LinkedTo',1,0,'C');
             $this->Cell(40,10,'Subject Name',1,0,'C');
             $this->Cell(22,10,'Alias',1,0,'C');
             $this->Cell(32,10,'Country',1,0,'C');
             $this->Ln();
         }
         


        
         function viewTable($data){
             include('databaseconnection.php');
             $this->SetFont('Times','',12);
              for($i=0; $i<sizeof($data); $i++){
                $this->Cell(40,10,$data[$i][0],1,0,'C');
                $this->Cell(20,10,$data[$i][1],1,0,'L');
                $this->Cell(30,10,$data[$i][2],1,0,'L');
                $this->Cell(25,10,$data[$i][3],1,0,'C');
                $this->Cell(40,10,$data[$i][4],1,0,'L');
                $this->Cell(40,10,$data[$i][5],1,0,'L');
                $this->Cell(22,10,$data[$i][6],1,0,'C');
                $this->Cell(32,10,$data[$i][7],1,0,'C');
                $this->Ln();
              }
         }

    }

    $pdf = new PDF();
     $pdf->AliasNbPages();
     $pdf->AddPage('L','A4',0);
     $pdf->headerTable();
     $pdf->viewTable($data);
     $pdf->Output();
?>