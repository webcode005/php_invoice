<?php
//call the FPDF library
require('fpdf184/fpdf.php');

$ord_date=date('d/m/Y');
$ord_id="1234656";

$inv_no = "MC00" .$ord_id;

$payment_type="SARKMIGS";
$product="HR Analytics";


$fname = "Basant";
$lname="Mallick";
$customer_name = $fname .' '.$lname;;
$useremail="anabtawi86@gmail.com";
$mobile="+91345645747";

$city='city';
$pincode='110093';
$state='state';
$country='country';

$address="lalita park laxmi nagar";

// $address=$address.''.$city.'<br>' .$pincode.'<br>'.$state.'<br>'.$country;

$price="3250";

$coupon_value="200";

$pay_gross="3050";



//create pdf object
$pdf = new FPDF('P','mm','A4');
//add new page
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )


$image1 = "img/logo.png";
$pdf->Cell(130, 50, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 43.78), 0, 0, 'L', false );



// $pdf->Cell(130 ,5,'MINDCYPRESS',0,0);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line
$pdf->SetTextColor(0,0,0);
//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,22,'19 Walker Ave STE 201,',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,23,'Pikesville MD 21208
+ 1-667-308-8019 |',0,0);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(25 ,5,'INVOICE ',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(34 ,5,'# '.$inv_no.'.',0,1);//end of line

$pdf->Cell(130 ,24,'support@mindcypress.com',0,0);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(34 ,5,$ord_date.'',0,1);//end of line

// $pdf->Cell(130 ,5,'Fax [+12345678]',0,0);
// $pdf->Cell(25 ,5,'Customer ID',0,0);
// $pdf->Cell(34 ,5,'[1234567]',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

$pdf->SetFont('Arial','B',14);

//billing address
$pdf->Cell(100 ,15,'TO',0,0);//end of line
$pdf->Cell(5);

$pdf->SetTextColor(0,153,51);

$pdf->Cell(59 ,5,'MODE OF PAYMENT ',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(34 ,5,$payment_type.'',0,1);//end of line
$pdf->Cell(110);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(59 ,8,'ATTENTION NAME ',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(34,8,'N/A',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

//add dummy cell at beginning of each line for indentation
$pdf->Cell(5 ,5,'',0,0);
$pdf->Cell(90 ,5,$customer_name.'',0,1);


$pdf->Cell(5 ,5,'',0,0);
$pdf->Cell(90 ,5,$useremail.'',0,1);

$pdf->Cell(5 ,5,'',0,0);
$pdf->Cell(90 ,5,$address.' '.$pincode,0,1);

$pdf->Cell(5 ,5,'',0,0);
$pdf->Cell(90 ,5,$city.' '.$country.' ',0,1);


$pdf->Cell(5 ,5,'',0,0);
$pdf->Cell(90 ,5,$mobile.'',0,1);


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line



//invoice contents
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(130 ,5,'Description',1,0);
$pdf->Cell(25 ,5,'Quantity',1,0);
$pdf->Cell(34 ,5,'Amount (USD)',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter
$pdf->SetTextColor(0,0,0);
$pdf->Cell(130 ,5,$product.'',1,0);
$pdf->Cell(25 ,5,'1',1,0);
$pdf->Cell(34 ,5,$price.'',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'Supaclean Diswasher',1,0);
// $pdf->Cell(25 ,5,'-',1,0);
// $pdf->Cell(34 ,5,'1,200',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'Something Else',1,0);
// $pdf->Cell(25 ,5,'-',1,0);
// $pdf->Cell(34 ,5,'1,000',1,1,'R');//end of line



$pdf->Cell(130 ,5,'',0,0);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(25 ,5,'Discount',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(30 ,5,$coupon_value.'',1,1,'R');//end of line

//summary
// $pdf->Cell(130 ,5,'',0,0);
// $pdf->SetTextColor(0,153,51);
// $pdf->Cell(25 ,5,'Subtotal',0,0);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'4,450',1,1,'R');//end of line

// $pdf->Cell(130 ,5,'',0,0);
// $pdf->Cell(25 ,5,'Tax Rate',0,0);
// $pdf->Cell(4 ,5,'$',1,0);
// $pdf->Cell(30 ,5,'10%',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(25 ,5,'Total Paid',0,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(4 ,5,'$',1,0);
$pdf->Cell(30 ,5,$pay_gross.'',1,1,'R');//end of line




//invoice contents
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,45,'If you have any questions concerning this invoice, (+1) 667-308-8019 | support@mindcypress.com ',0,0);
$pdf->Cell(-70);
$pdf->SetFont('Arial','B',12);
$pdf->SetTextColor(0,153,51);
$pdf->Cell(130 ,65,'THANK YOU FOR YOUR BUSINESS!',0,0);


//output the result
 $pdf->Output();
 $file_name="abc".time();
$pdf->Output('F','invoice/'.$inv_no.'.pdf'); 
?>



