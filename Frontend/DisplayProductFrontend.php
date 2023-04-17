<?php
session_start();
if(@$_SESSION["autoriser"]!="oui"){
	header("location:../Frontend/SignIn.php");
	exit();
} ?>
<?php require_once '../Backend/con.php'; ?>
<?php require 'head.html'; ?>
<?php require 'navbar.html'; ?>

<html>
<body>
	<div class="text-center mt-5 mb-2">	
		<div class="pt-2">
			<a href="../Frontend/CreateProductFrontend.php" class="btn bg-dark bg-gradient text-white container py-3 fw-bold"> Create </a>
		</div>
	</div>
	<div class="container table-responsive mb-2">
		<table class="table border border-light-subtle">
			<thead>
				<tr class="bg-dark bg-gradient text-light text-center fs-5 border border-light">
					<th class="text-dark bg-light border border-dark border-4">Number</th>
					<th> Name </th>
					<th> Number </th>
					<th> Category </th>
					<th> Supplier </th>
					<th> Actions </th>
				</tr>
			</thead>

			<?php

			$req=$con->prepare("SELECT p.* , c.name AS category, s.name AS supplier FROM product p JOIN category c ON p.idC = c.idC JOIN supplier s ON p.idS = s.idS ORDER BY p.idP");
			$req->execute();
			$row_T = $req->get_result()->fetch_all(MYSQLI_ASSOC);


			foreach ($row_T as $row)
				{   ?>

					<tr class="text-center">
						<td class="fw-bold bg-dark bg-gradient text-light fs-5 border border-light" ><?php echo $row['idP']; ?></td>
						<td ><?php echo $row['name']; ?></td>
						<td ><?php echo $row['number']; ?></td>
						<td ><?php echo $row['category']; ?></td>
						<td ><?php echo $row['supplier']; ?></td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-warning border border-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
									Action
								</button>
								<ul class="dropdown-menu border border-dark">
									<li><a class="dropdown-item text-center" href="UpdateProductFrontend.php?id=<?php echo $row["idP"]; ?>'"><button class="btn bg-info text-white border-dark">Update</button></a></li>
									<li><a class="dropdown-item text-center" href="../Backend/DeleteProductBackend.php?id=<?php echo $row["idP"]; ?>'"><button class="btn bg-danger text-white bg-opacity-75 border-dark">Delete</button></a></li>
								</ul>
							</div>
						</td>
					</tr>
				<?php } ?>
			</table>				
		</div>
	</body>
	<div class="py-5"></div>
	<div class="fixed-bottom">
		<?php require 'fouter.html'; ?>
	</div>
	</html>


