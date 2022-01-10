<?php 

include'index1.php';

    $file="invoice/".$inv_no.'.pdf';
    
    $size=filesize($file); 
  
     $to = "basant.malick@ictlsquad.com";
     
     $subject = "Career Enquiry Detail";
          
            // Sender 
            $from = 'support@mindcypress.com'; 
            $fromName = 'Mindcypress'; 
          
          // Email body content 
        $htmlContent = " 
             <p><b>Name:</b> ".$name."</p>
                  <p><b>Email ID:</b> ".$email."</p>
                  <p><b>Mobile Number:</b> ".$phone."</p>          
                  <p><b>Position For:</b> ".$categ."</p>
                  <p><b>User Exp:</b> ".$userexp."</p>
            
            
        "; 
 
        // Header for sender info 
        $headers = "From: $fromName"." <".$from.">"; 
         
        // Boundary  
        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
         
        // Headers for attachment  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
         
        // Multipart boundary  
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
         
        // Preparing attachment 
        if(!empty($file) > 0){ 
            if(is_file($file)){ 
                $message .= "--{$mime_boundary}\n"; 
                $fp =    @fopen($file,"rb"); 
                $data =  @fread($fp,filesize($file)); 
         
                @fclose($fp); 
                $data = chunk_split(base64_encode($data)); 
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
                "Content-Description: ".basename($file)."\n" . 
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
            } 
        } 
        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $from; 
 
// Send email 

         
          $retval = @mail($to, $subject, $message, $headers, $returnpath); 
         
           if( $retval == true ) 
    {
       echo "File Sent Successfully123.";
       die();
       //unlink($name); // delete the file after attachment sent.
    }
    else
    {
       die("Sorry but the email could not be sent.
                    Please go back and try again!");
    }

//}
?>