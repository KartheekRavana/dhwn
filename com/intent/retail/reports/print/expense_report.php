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
				if($_GET['exp']=='All'){
					$q=" and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."'  ";
				}
				else{
					$q=" and tran_date between '".$_GET["from_date"]."' and '".$_GET["to_date"]."' and tran_desc='".$_GET['exp']."' ";
           		}
           		if($_GET["from_date"]=="" && $_GET["to_date"]==""){$q="";}
            	$received_amt=0;
            ?>
            <div class="c">
              
              <div class="">
               
                <div class="" style="overflow: auto;">
                <table id="example1" class="" border=1  style="font-size: 12px;border-collapse: collapse;width:100%;">
                    <thead>
                      <tr>
                        <th>Expense&nbsp;Date</th><th>Expense Name</th><th>Note</th>
                        <th>Amount</th>
                      
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $credit_payment=0;$i=1;
                   // echo "SELECT sk_tran_id,tran_date,tran_time,credit,debit,note,tran_type,tran_desc FROM txn_transaction where tran_type='Expense' $q";
                    $data = mysql_query("SELECT sk_tran_id,tran_date,tran_time,credit,debit,note,tran_type,tran_desc FROM txn_transaction where tran_type='Expense' $q order by tran_date");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							
	                		$credit_payment=$credit_payment+$info["debit"];     
                    ?><tr>
                    <td><?php $temp=explode("-", $info["tran_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></td>
                    <td><?php echo $info["tran_desc"]?></td>
                  	<td><?php echo $info["note"]?></td>
                    <td><?php echo $info["debit"]?></td>
                  
                   
                  
                    </tr>
                    
                    <?php $i++;}?>
                                </tbody>
                                    <tfoot>
                                    <tr><td></td><td></td><td></td><td><?php echo $credit_payment?></td></tr>
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
		     function(){ window.location="?action=expense_report&c=reports"; },
		      1000
		    );           
</script>
</body>
</html>