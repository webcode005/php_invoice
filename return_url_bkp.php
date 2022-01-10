<?php

/**
 * A sample code to illustrate how a payment response will be handled.
 *
 * This sample is only for illustration and hasn't been tested yet.
 * 
 * @author Kareem Mohamed <kareem3d.a@gmail.com> 
 */

require __DIR__ . '/functions.php';

$transaction['status'] = getInput('vpc_TxnResponseCode');
$txn_id=$transaction['key']    = getInput('vpc_TransactionNo');
$transaction['message'] = getInput('vpc_Message');

$emaillist="basant.malick@ictlsquad.com";

// $reference = getInput('vpc_MerchTxnRef');
// Get order from the database by the `$reference` generated random number in the request process

if($transaction['status'] == "0" && $transaction['message'] == "Approved") {

    // Save transaction information in the database
    // Display transaction details
    $payment_type='MIGS';
    
    $payment_status='Success';
   
     //$useremail=$transaction['user_email'] = getInput('user_email');
     $priceid=$transaction['price_id'] = getInput('price_id');
     //$coupon_name=$transaction['coupon_name'] = getInput('coupon_name');
     $total=$transaction['vpc_Amount'] = getInput('vpc_Amount');
       $pay_gross=chop($total,"00");
        
    
     $ord_id=$transaction['orderid'] = getInput('orderid');
     $order_date=date('d M Y');
    
	// Database Connection

		$host="localhost";
		$username="j2c9i7h5_basant";
		$password="Mind@cypress";
		$dbname="j2c9i7h5_mindcypree_php";

		$conn=new mysqli("$host","$username","$password","$dbname");
		
		$prodArr=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `tl_price` WHERE `id`='$priceid'"));

        $product_id=$prodArr['prod_id'];
        $price=$prodArr['p_price'];
        
        $prodA=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `tl_product` WHERE `detail_id`='$product_id'"));

        $product=$prodA['title'];
        
        $ord=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `order` WHERE `id`='$ord_id'"));

        $useremail=$ord['u_email'];
        $fname=ucfirst($ord['fname']);
        $lname=ucfirst($ord['lname']);
        $coupon_name=$ord['coupon_name'];
        $coupon_value=$ord['coupon_value'];
        $company_name=$ord['company_name'];
        $address=$ord['address'];
        $city=$ord['city'];
        $pincode=$ord['pincode'];
        $state=$ord['state'];
        $country=$ord['country'];
        $email=$ord['u_email'];
        $mobile=$ord['phone'];
        
        $subtotal= $price-$coupon_value;
        $pay_gross=$subtotal;
        
        


		$sql="INSERT INTO `payments` (`user_email`,`order_id`, `price_id`, `prod_name`,`coupon_name`,`coupon_value`, `txn_id`,`payment_type`, `payment_gross`, `currency_code`, `payment_status`, `ord_date`) VALUES ('$useremail', '$ord_id', '$priceid', '$product','$coupon_name','$coupon_value', '$txn_id','$payment_type', '$pay_gross', 'USD', '$payment_status','$order_date')";

		if ($conn->query($sql) === TRUE) {
		
 // Send Mail
        
          $to = "alice.hanna@mindcypress.org,jessica.jones@mindcypress.org,sachin.nandal@mindcypress.org,yogesh.panchal@mindcypress.com,prateek.srivastava@ictlsquad.com,basant.mallick@mindcypress.com";
          
           $subject = " [MindCypress Online Learning, Classroom Training, Career Inhance]: Payment $payment_status #$ord_id";
        //   $message .= "<b>New Order Recieved :</b>" ."<br>";
           include'email_template.php';
           $message .="$htnl";
           $header = "From: $email \r\n";
           $header .= 'Reply-To: '.$fname .'' .$lname.'<'.$email.'>' . "\r\n";
           $header .= "MIME-Version: 1.0\r\n";
           $header .= "Content-type: text/html\r\n";
           $header .= "Bcc: $emailList\r\n";
         
           $retval = mail ($to,$subject,$message,$header);
         
           if( $retval == true ) 
           {
		
      //  Send Thank You Mail
		    
$to1 = $email; 
$from1 = 'cs@mindcypress.biz'; 
$fromName1 = 'Mindcypress Customer Service'; 
 
$subject1 = "MindCypress Invoice &amp; Enrollment Details for Training"; 


include'invoice-order.php';
$htmlContent ="$html1";
// Set content-type header for sending HTML email 
$headers1 = "MIME-Version: 1.0" . "\r\n"; 
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers1 .= 'From: '.$fromName1.'<'.$from1.'>' . "\r\n";
$headers1 .= 'Reply-To: support@mindcypress.com<Mindcypress>' . "\r\n"; 
$headers1 .="Bcc: $emaillist\r\n";


mail($to1, $subject1, $htmlContent, $headers1); 

            //echo "Successfully subscribe for Newsletter";
 
			//echo "<script>alert('Thank you for the message. We will contact you shortly.');window.location.href ='index.php'</script>";
}
//Mail End

	echo "<script>alert('Payment Successful.');window.location.href ='../index'</script>";
		
		} 
		else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
             }
    
             
             
          }
   
    
    
 
 else {

    // Display error
    
    // Save transaction information in the database
    // Display transaction details
    $payment_type='MIGS';
    
    $payment_status='Failed';
   
     //$useremail=$transaction['user_email'] = getInput('user_email');
     $priceid=$transaction['price_id'] = getInput('price_id');
     //$coupon_name=$transaction['coupon_name'] = getInput('coupon_name');
     $total=$transaction['vpc_Amount'] = getInput('vpc_Amount');
     //$pay_gross=chop($total,"00");
    $pay_gross = str_replace(".00","",$total);
     
     
     
     $ord_id=$transaction['orderid'] = getInput('orderid');
     $order_date=date('d M Y');
    
	// Database Connection

		$host="localhost";
		$username="j2c9i7h5_basant";
		$password="Mind@cypress";
		$dbname="j2c9i7h5_mindcypree_php";

		$conn=new mysqli("$host","$username","$password","$dbname");
		
		$prodArr=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `tl_price` WHERE `id`='$priceid'"));

        $product_id=$prodArr['prod_id'];
        $price=$prodArr['p_price'];
        
        $prodA=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `tl_product` WHERE `detail_id`='$product_id'"));

        $product=$prodA['title'];
        
        $ord=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `order` WHERE `id`='$ord_id'"));

        $useremail=$ord['u_email'];
        $fname=ucfirst($ord['fname']);
        $lname=ucfirst($ord['lname']);
        $coupon_name=$ord['coupon_name'];
        $coupon_value=$ord['coupon_value'];
        $company_name=$ord['company_name'];
        $address=$ord['address'];
        $city=$ord['city'];
        $pincode=$ord['pincode'];
        $state=$ord['state'];
        $country=$ord['country'];
        $email=$ord['email'];
        $mobile=$ord['phone'];
        
        $subtotal= $price-$coupon_value;
        $pay_gross=$subtotal;


		$sql="INSERT INTO `payments` (`user_email`,`order_id`, `price_id`, `prod_name`,`coupon_name`,`coupon_value`, `txn_id`,`payment_type`, `payment_gross`, `currency_code`, `payment_status`, `ord_date`) VALUES ('$useremail', '$ord_id', '$priceid', '$product','$coupon_name','$coupon_value', '$txn_id','$payment_type', '$pay_gross', 'USD', '$payment_status','$order_date')";

		if ($conn->query($sql) === TRUE) {
		

	echo "<script>alert('Payment Failed.');window.location.href ='../index'</script>";
		
		} 
		else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
             }
    
             
}