<?php include_once "$D_PATH/include/session.php";?><?php 
$bill_no=$_GET["pid"];
$c_email="";
$message="<div style='width:330px;margin-left:200px;font-size: 12px'>";
	          $data = mysql_query("SELECT supplier_id FROM supplierorderformmain where bill_no='".$bill_no."'");
	          while($info = mysql_fetch_array( $data ))
	          {
	          	if($info["supplier_id"]==0){$c=$info["supplier_id"];}
	          	else{
	          		
$data1 = mysql_query("SELECT member_name,email FROM mst_member where sk_member_id='".$info["supplier_id"]."'");
while($info1 = mysql_fetch_array( $data1 ))
{
	$c=$info1["member_name"];
	$c_email=$info1['email'];
}

	          	}
	          ?>
	            <input type='hidden' id='bill_no' name='bill_no' value='<?php echo $info['bill_no']?>'>
	           <?php $message1=$message1."<center style='font-weight: bold;'>Order Form</center>";?>
	           <?php $message1=$message1."<table style='width: 100%;font-size:12px'>";
	            $message1=$message1."<tr><td rowspan='2'>Seller&nbsp;Name : $c<br/>Place : ".$info["city"]."<br/>Mobile : ".$info["phone"]."</td><td colspan='2'>Ref No : ".$info['bill_no']."<br/>Date : ".$_SESSION['date1']."</td></tr><tr></tr></table>";	           
	           }
	           $message1=$message1."<hr width='100%' color='black'>";
$message1=$message1."<table cellspacing=0 cellpadding=0 border='#000' style='width: 100%;font-size: 12px'><tr><th>SlNo</th><th>Particulars&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><th>Qty/Pcs</th><th>Qty</th></tr>";
	           
$i=1;
	          
	           $data = mysql_query("SELECT bill_no, item_date, item_name,description, item_qty, item_rate, amt, item_qty_p,tran_id FROM supplierorderform where bill_no='".$bill_no."'");
	           while($info = mysql_fetch_array( $data ))
	           {
	           	$item_name="";
	           	$thickness="";
	           	$size="";
	           	$data1 = mysql_query("SELECT item_name,thickness, length, breadth FROM items where item_id='".$info["item_name"]."'");
	           	while($info1 = mysql_fetch_array( $data1 ))
	           	{
	           		$item_name=$info1["item_name"];
	           	if($info1["thickness"]!=0)
	           		{
	           		$thickness=$info1["thickness"]."mm";
	           		$size="(".$info1["length"]."*".$info1["breadth"].")";
	           		}
	           	}
	           	if($info["item_name"]=="3")
	           	{
	           		$qty=$info["item_qty"];
	           	}
	           	else {
					$qty=$info["item_qty"];
				}
				
			$item_name=$item_name."(".$info["description"].")";
				
	          $message1=$message1."<tr style='border-bottom-color: white;border-top-color: white' ><td>".$i."</td><td style='border-bottom : 0;border-top: 0'>".$item_name."</td><td style='border-bottom : 0;border-top: 0;text-align: center;'>".$info["item_qty_p"]."</td><td style='border-bottom : 0;border-top: 0;text-align: center;'>".$qty."</td></tr>";
$i++;}


$to = $c_email;
$subject = "Dharani Hardwares Bellary Order Form For ".$c ;
$headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
$headers .= "From: dharanihardwares@gmail.com" . "\r\n";

$message="<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  </head>
  <body style='margin: 0; padding: 0'>
    <table cellpadding='20' cellspacing='0' width='100%' align='center' bgcolor='#dbdbdb'>
      <tbody>
        <tr>
          <td style='padding: 10px 10px 10px 10px;max-width: 650px;display: block;margin: 0 auto;'>
            <!--[if (gte mso 9)|(IE)]-->
            <table width='100%' align='center'>
              <tr>
                <td></td>
              </tr>
            </table>
            <!--[endif]-->
            <table cellpadding='20' cellspacing='0' align='center' width='100%'>
              <tbody>
                <!--White block-->
                <tr>
                  <td style='padding:0px 0px 0px 0px;' class='white-block'>
                    <table bgcolor='white' style='padding: 15px 15px 15px 15px;border-radius: 4px;box-shadow: 0 0 20px 5px rgba(0,0,0,0.1);' align='center'>
                      <tbody>
                        
                      
                        <tr>
                          <td style='padding: 50px 20px 50px 20px;'>
                            <table>
                              <tbody>
                                <tr>
                                  <td>
                                    <h2 style='color: #ff6600;text-transform: uppercase;font-family: helvetica;' class='mailer-title'>New Order Form For $c</h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    <p style='font-size: 14px;line-height: 26px;color: #666;font-family: helvetica;' class='mailer-text'></p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' style='padding-bottom:25px;'>$message1</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <!--END: White block-->
                <!--Footer block-->
                <tr>
                  <td style='padding: 0px 0px 0px 0px'>
                    <table>
                      <tbody>
                       
                        <tr>
                          <td style='padding-top: 15px;'>
                            <table>
                              <tbody>
                                <tr>
                                  <td><a href='#' style='color:#868686;font-family: helvetica;font-size: 10px;'>Unsubscribe</a></td>
                                  <td style='padding-left: 15px;'><a href='#' style='color:#868686;font-family: helvetica;font-size: 10px;'>Terms & Conditions</a></td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <!--END: Footer block-->
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>";

mail($to,$subject,$message,$headers);
/*
 // declare our variables
$name = "DHARANI GRANITES";
$email = "dharanihardwares@gmail.com";
$message = nl2br($message);

// set a title for the message
$subject = "Order from Dharani Hardwares";
$body = "From $name, \n\n$message";
$headers = 'From: '.$email.'' . "\r\n" .
    'Reply-To: '.$email.'' . "\r\n" .
	'Content-type: text/html; charset=utf-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// put your email address here
mail($c_email, $subject, $body, $headers);*/
?>
 </div>
 <script>
 //self.print();
 setTimeout(function() { window.location="?action=index&c=dashboard"; }, 2000);
 </script>