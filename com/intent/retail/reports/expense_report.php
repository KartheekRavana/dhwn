<?php include_once "$D_PATH/include/session.php";?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include_once "$D_PATH/include/title.php";?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
 <?php include_once "$D_PATH/include/scripts_top.php";?>
  
  </head>
   <body class="<?php echo $body_style?>">
    <div class="wrapper">
      
      	<?php include_once "$D_PATH/include/header.php";?>
  	
  <!-- Left side column. contains the logo and sidebar -->
  
    <?php include_once "$D_PATH/include/side.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php include_once "$D_PATH/include/navigation.php";?>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            
                <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Expense Report</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                
                <form action='?action=financial&c=reports'>
                <input type="hidden" name="action" value="expense_report">
                <input type="hidden" name="c" value="reports">
                     <table>
                      <tr><td>From Date</td><td>	          
                        <input type='date' name='from_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['from_date'])){echo $_GET['from_date'];}else{ echo $date1;}?>'>
                        </td><td></td>
                        <td>To Date</td><td>	          
                        <input type='date' name='to_date' class="form-control" id="inputDate" value='<?php  if(isset($_GET['to_date'])){echo $_GET['to_date'];}else{ echo $date1;}?>'>
                        </td><td></td><td>
                         <td>To Date</td><td>	          
                        <select name="exp" class="form-control" id="exp">
                        <option value="All">All</option>
                        <?php 
                        $data = mysql_query("SELECT expense_id,expense_name FROM mst_expenselist");
	                	while($info = mysql_fetch_array( $data ))
	                	{    
                        ?>
                        <option value="<?php echo $info["expense_name"]?>"><?php echo $info["expense_name"]?></option>
                        <?php }?>
                        </select>
                        </td><td></td><td>
                        <input type="submit" value='Get Report'/>&nbsp;
                         <?php 
                        if(isset($_GET["from_date"]))
                        {	?>
                        	<a class='btn btn-success' href="?action=print/expense_report&c=reports&exp=<?php echo $_GET["exp"]?>&from_date=<?php echo $_GET['from_date']?>&to_date=<?php echo $_GET['to_date']?>">Print</a>
                        	<?php 
                        }
                        ?></td>
                      </tr></table>
                        </form><br/>
                        </div>
                        </div>
                        </div>
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
            <div class="col-md-12">
              
              <div class="box">
               
                <div class="box-body" style="overflow: auto;">
                <table id="example" class="table table-bordered table-striped" style="font-size: 12px">
                    <thead>
                      <tr>
                        <th>Expense&nbsp;Date</th><th>Expense Name</th><th>Note</th>
                        <th>Amount</th>
                      
                      </tr>
                    </thead>
                    <tbody id='div_print' style="font-size: 12px;">
                    <?php
                    $credit_payment=0;$i=1;
                  // echo "SELECT sk_tran_id,tran_date,tran_time,credit,debit,note,tran_type,tran_desc FROM txn_transaction where tran_type='Expense' $q order by tran_date";
                    $data = mysql_query("SELECT sk_tran_id,tran_date,tran_time,credit,debit,note,tran_type,tran_desc FROM txn_transaction where tran_type='Expense' $q order by tran_date");
	                	while($info = mysql_fetch_array( $data ))
	                	{      
							
	                		$credit_payment=$credit_payment+$info["debit"];     
                    ?><tr>
                    <td><a href='?action=expense_edit&c=reports&tid=<?php echo $info["sk_tran_id"]?>' target="blank"><?php $temp=explode("-", $info["tran_date"]);echo $temp[2]."-".$temp[1]."-".$temp[0]?></a></td>
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
 <?php include_once "$D_PATH/include/footer.php";?>

  <!-- Control Sidebar -->
 <?php include_once "$D_PATH/include/side_container.php";?> 
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php include_once "$D_PATH/include/scripts_bottom.php";?> 
</body>
</html>