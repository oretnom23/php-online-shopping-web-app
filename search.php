<?php include 'inc/header.php';?>


<?php 
$search = mysqli_real_escape_string($db->link,$_GET['search']);
if (!isset($search) || $search == NULL) {
	header("Location:404.php");
} else {

$search = $search;

}



?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>All Searching Product</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">

<?php 

	$query = "select * from tbl_product where productName like '%$search%' or body like '%$search%' ORDER BY productId DESC LIMIT 30";

	$post = $db->select($query);

	if ($post) {
		
	while ($result = $post->fetch_assoc()) {
		
	

	 ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'],60); ?></p>
					 <p><span class="price">TK.<?php echo $result['price']; ?></span></p>
				      <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } else { ?>

					<p style="color: red;font-size: 35px;font-weight: bold;text-align: center;">Your Seaech Query not found !!.</p>
				<?php } ?>
				
				
				
			</div>
		
    </div>
 </div>
<?php include 'inc/footer.php';?>