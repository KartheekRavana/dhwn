<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>

   <body >
    <div >
      
      	
  	
  
  <div class="">
    <!-- Content Header (Page header) -->
    
    
        <!-- Main content -->
        <section class="">
          <div class="">
            
                
            <!-- right column -->
            <?php $q="";
            if(isset($_GET["from_date"]))
			{	
				if($_GET['tran_type']=='Customer' || $_GET['tran_type']=='Bank')
				{
					if($_GET['tran']=='Receipt')
					{
						$q="where (tran_type='".$_GET['tran_type']."') and debit>0 and (tran_desc='Payment' ) and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
					else
					{
						$q="where (tran_type='".$_GET['tran_type']."') and credit>0 and (tran_desc='Payment Return') and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
				}
				else 
				{
					if($_GET['tran']=='Payment')
					{
						$q="where (tran_type='".$_GET['tran_type']."') and debit>0 and (tran_desc='Payment' ) and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
					else
					{
						$q="where (tran_type='".$_GET['tran_type']."') and credit>0 and (tran_desc='Payment Return') and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' order by tran_date ";
					}
				}
            	$received_amt=0;
            ?>
            <div class="c">
              
              <div class="">
               
                <div class="" style="overflow: auto;">
                <table border=1 style="font-size: 12px;border-collapse: collapse;">
					<caption><b><?php echo $_GET['tran_type'].' '.$_GET['tran']?></b></caption>
                    <thead>
                    <?php if($_GET['tran']=='Receipt'){?>
                      <tr>
                        <th>Date</th>
                        <th>Bank/Cash</th>
                        <th>Received From</th> 
                        <th>Amount</th>
                        <th>Note</th>
                      </tr>
                     <?php }else{?>
                     	<tr>
                        <th>Date</th>
                        <th>Bank/Cash</th>
                        <th>Paid To</th> 
                        <th>Amount</th>
                        <th>Note</th>
                      </tr>
                     <?php }?>
                    </thead>
                    <tbody id='div_print'  style="font-size: 12px;">
                    <?php 
                  
                    $credit_payment=0;
                    //echo "SELECT sk_tran_id,tran_date,debit,credit,tran_desc,member_id FROM txn_transaction $q";
                    $data = mysql_query("SELECT * FROM txn_transaction $q");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							$member_name="";
							$ref_id=$info['transaction_ref_id'];
							$member_id=$info["member_id"];
							$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
							while($info1 = mysql_fetch_array( $data1 ))
							{
								$member_name=$info1["member_name"];
							}
							$bank_name="";$payment="";
							if($ref_id==0)
							{
								$payment="Cash";
								
							}
							else 
							{
								$payment="Bank";
								$data2=mysql_query("select member_id from txn_transaction where sk_tran_id='$ref_id' ");
								while($info2=mysql_fetch_array($data2))
								{
									$member_id=$info2["member_id"];
									$data1 = mysql_query("SELECT member_name FROM mst_member where sk_member_id='$member_id'");
									while($info1 = mysql_fetch_array( $data1 ))
									{
										$bank_name=$info1["member_name"];
									}
								}
								
							}
						
	                		   

	                		   if($info["debit"]>0){
									$credit_payment=$credit_payment+$info["debit"];
                    ?><tr>
                    	<td><?php echo date("d-m-Y",strtotime($info["tran_date"]))?></td>
                  		<td><?php echo $payment.'-'.$bank_name?></td>
	                    <td><?php echo $member_name?></td>
	                    
	                    <td><?php echo $info["debit"]?></td>
	                    <td><?php echo $info['note']?></td>
                    </tr>
                    
                    <?php }
                    if($info["credit"]>0){
						$credit_payment=$credit_payment+$info["credit"];
                    	?><tr>
                                        <td><?php echo date("d-m-Y",strtotime($info["tran_date"]))?></td>
                                        <td><?php echo $payment.'-'.$bank_name?></td>
                                        <td><?php echo $member_name?></td>
                                        <td><?php echo $info["tran_date"]?></td>
                                        <td><?php echo $info["credit"]?></td>
                                        <td><?php echo $info['note']?></td>
                                        </tr>
                                        
                                        <?php }
	                	}?>
                     
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $credit_payment?></td><td></td></tr>
                                    </tfoot>
                  </table>
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              
             
              
              
                    
    	</div>   
               <?php }?>  
                 
                 
          </div>   <!-- /.row -->
        </section><!-- /.content -->
 </div><!-- /.content-wrapper -->
 
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class=""></div>
</div>
<!-- ./wrapper -->


<script type="text/javascript">
   window.print();    
   setInterval(
		     function(){ window.location="?action=pr_report&c=reports"; },
		      1000
		    );           
</script>
</body>
</html>