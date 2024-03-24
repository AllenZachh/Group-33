<?php

include('fpdf186/fpdf.php'); // path to the library file

require_once('../connectdb.php'); //connect to db

if(isset($_POST['btn_stock']))
{

  $var1 = $db->prepare("SELECT * FROM product");
  $var1->execute();

  $results = $var1->fetchAll(PDO::FETCH_ASSOC);

 

  $pdf = new FPDF();  
  $pdf->SetFont('Arial','B',10);
  $pdf->AddPage();
  $pdf -> cell(25,10,'ProductID',1,0,'C');
  $pdf -> cell(45,10,'ProductTypeID',1,0,'C');
  $pdf -> cell(45,10,'Stock',1,0,'C');
  $pdf -> cell(30,10,'Colour',1,0,'C');
  $pdf -> cell(30,10,'Size',1,1,'C');


  $pdf->SetFont('Arial','',10); 

  foreach ($results as $row) {
      $pdf->Cell(25, 10, $row['productid'], 1, 0, 'C');
      $pdf->Cell(45, 10, $row['productTypeid'], 1, 0, 'C');
      $pdf->Cell(45, 10, $row['stock'], 1, 0, 'C');
      $pdf->Cell(30, 10, $row['colour'], 1, 0, 'C');
      $pdf->Cell(30, 10, $row['size'], 1, 1, 'C'); 
  }
  
 
  $pdf->Output();
}


////////////////////////////////////////////////////////////

elseif(isset($_POST['btn_orders']))
{

  
  $var2 = $db->prepare("SELECT * FROM orderitems");
  $var2->execute();

  $result2 = $var2->fetchAll(PDO::FETCH_ASSOC);

 

  $pdf = new FPDF();  
  $pdf->SetFont('Arial','B',10);
  $pdf->AddPage();
  $pdf -> cell(25,10,'OrderItemID',1,0,'C');
  $pdf -> cell(45,10,'OrderID',1,0,'C');
  $pdf -> cell(45,10,'ProductID',1,0,'C');
  $pdf -> cell(30,10,'Quantity',1,1,'C');



  $pdf->SetFont('Arial','',10); 

  foreach ($result2 as $row) {
      $pdf->Cell(25, 10, $row['orderItemsid'], 1, 0, 'C');
      $pdf->Cell(45, 10, $row['orderid'], 1, 0, 'C');
      $pdf->Cell(45, 10, $row['productid'], 1, 0, 'C');
      $pdf->Cell(30, 10, $row['quantity'], 1, 1, 'C');
  }
  
 
  $pdf->Output();

}


////////////////////////////////////////////////////////////////

elseif(isset($_POST['btn_sales']))
{
  $var3 = $db->prepare("SELECT * FROM `order`");
  $var3->execute();

  $result3 = $var3->fetchAll(PDO::FETCH_ASSOC);

 

  $pdf = new FPDF();  
  $pdf->SetFont('Arial','B',10);
  $pdf->AddPage();
  $pdf -> cell(45,10,'OrderID',1,0,'C');
  $pdf -> cell(45,10,'userid',1,0,'C');
  $pdf -> cell(30,10,'datePlaced',1,1,'C');



  $pdf->SetFont('Arial','',10); 

  foreach ($result3 as $row) {
      $pdf->Cell(45, 10, $row['orderid'], 1, 0, 'C');
      $pdf->Cell(45, 10, $row['userid'], 1, 0, 'C');
      $pdf->Cell(30, 10, $row['datePlaced'], 1, 1, 'C');
  }
  
 
  $pdf->Output();

}



?>
    




