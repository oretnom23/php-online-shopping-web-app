<?php include 'inc/header.php';?>
<?php 
$login = Session::get("cuslogin");
if ($login == false) {
    header("Location:login.php");
}
 ?>


<?php 
if (isset($_GET['customerId'])) {
    $id = $_GET['customerId'];
    $confirm = $ct->productShiftConfirm($id);

}

 ?>

 <style>
     .tblone tr td{text-align: justify;}

 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="order">
    			<h2>Your Ordered Details</h2>
                <table class="tblone">


                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <tr>

                            <?php 
                            $cmrId = Session::get("cmrId");
                            $getOrder = $ct->getOrderedProduct($cmrId);
                            if ($getOrder) {
                                $i = 0;
                                while ($result = $getOrder->fetch_assoc()) {
                                
                                $i++;

                             ?>
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['productName']; ?></td>
                                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                                <td><?php echo $result['quantity']; ?></td>
                    
                                <td>Tk. <?php echo $result['price'];?></td>
                         <td><?php echo $fm->formatDate($result['date']); ?></td>

                         <td><?php

                         if ($result['status'] == '0') {
                             echo "Pending";
                         }elseif($result['status'] == '1'){
                            echo "Shifted";
                       } else{ 
                            echo "Ok";
                         }


           ?></td>
                    </td>

                
                    <?php 
                    if ($result['status'] == '1') { ?>
                     <td> <a href="?customerId=<?php echo $result['id']; ?>">Confirm</a><td>
                   <?php } elseif($result['status'] == '2'){?>
                    <td>Ok</td>

                  <?php }elseif ($result['status'] == '0') {?>
                      <td>N/A</td>
                 <?php  }  ?>
                   
            </tr>
                            


                        <?php } } ?>    
                        </table>

    		</div>
    	</div>
    	
    	 	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>