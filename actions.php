<?php
	$conn = new mysqli("localhost:3307","root","","toyworld") OR die ("Error: " .mysqli_error($conn));
	session_start();
	//include 'confign.php';
	
	$update=false;
	$id="";
	$name="";
	$type="";
	$made_in="";
	$age="";
	$price="";

	if(isset($_POST['add']))
	{
		$name=$_POST['name'];
		$type=$_POST['type'];
		$made_in=$_POST['made_in'];
		$age=$_POST['age'];
		$price=$_POST['price'];

		 // $photo=$_FILES['image']['name'];
		 // $upload="uploads/".$photo;

		$image=$_FILES['image']['name'];
   		$tmp=$_FILES['image']['tmp_name'];
   		$photo="./uploads/".$image;

    	move_uploaded_file($tmp,$photo);


		$iQuery = "INSERT INTO toydetail (name, type, made_in, age, price, photo) values (?, ?, ?, ?, ?, ?)";

		$stmt = $conn->prepare($iQuery);
		$stmt->bind_param("sssiis",$name, $type, $made_in, $age, $price, $photo);
		$stmt->execute();
		
		$stmt->close();
		$conn->close();

		// $query="INSERT INTO store (Name,Type,Made_in,'Age (under)',Price,Photo)VALUES(?,?,?,?,?,?)";
		// $stmt=$conn->prepare($query);
		// $stmt->bind_param("sssiis",$name,$type,$made_in,$age,$price,$upload);
		// $stmt->execute();
		// move_uploaded_file($_FILES['image']['tmp_name'], $upload);

		header('location:inde.php'); 
		$_SESSION['response']="Successfully Inserted to the Database!";
	 	$_SESSION['res_type']="Success";
	}
	if(isset($_GET['delete']))
	{
		$id=$_GET['delete'];

		$sql="SELECT photo FROM toydetail WHERE id=?";
		$stmt2=$conn->prepare($sql);
		$stmt2->bind_param("i",$id);
		$stmt2->execute();
		$result2=$stmt2->get_result();
		$row=$result2->fetch_assoc();

		$imagepath=$row['photo'];
		unlink($imagepath);

		$query="DELETE FROM toydetail WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:inde.php'); 
		$_SESSION['response']="Successfully Deleted!";
	 	$_SESSION['res_type']="Success";
	}
	if(isset($_GET['edit']))
	{
		$id=$_GET['edit'];

		$query="SELECT * FROM toydetail WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$id=$row['id'];
		$name=$row['name'];
		$type=$row['type'];
		$made_in=$row['made_in'];
		$age=$row['age'];
		$price=$row['price'];
		$photo=$row['photo'];

		$update=true;
	}
	if(isset($_POST['update']))
	{
		$id=$_POST['id'];
		$name=$_POST['name'];
		$type=$_POST['type'];
		$made_in=$_POST['made_in'];
		$age=$_POST['age'];
		$price=$_POST['price'];
		$oldimage=$_POST['oldimage'];

		if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!=""))
		{
			$newimage="uploads/".$_FILES['image']['name'];
			unlink($oldimage);
			move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
		}
		else{
			$newimage=$oldimage;
		}
		$query="UPDATE toydetail SET name=?,type=?,made_in=?,age=?,price=?,photo=? WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssiisi",$name,$type,$made_in,$age,$price,$newimage,$id);
		$stmt->execute();

		$_SESSION['response']="Update Successfully!";
		$_SESSION['res_type']="primary";
		header('location:inde.php');
	}
	if(isset($_GET['details']))
	{
		$id=$_GET['details'];
		$query="SELECT * FROM toydetail WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$vid=$row['id'];
		$vname=$row['name'];
		$vtype=$row['type'];
		$vmade_in=$row['made_in'];
		$vage=$row['age'];
		$vprice=$row['price'];
		$vphoto=$row['photo'];
	}
?>