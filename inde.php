<?php
  include 'actions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Sahil Kumar">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
	<title>Toy Database</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Welcome to Admin!</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <!-- <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul> -->
    </div>
    <a href="index.html"><img src="img/Logo.png" alt="" title="" width="200px" height="50px" /></a>
    <!-- <form class="form-inline" action="/action_page.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </form> -->
  </nav>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h3 class="text-center text-dark mt-3">Toy Store for ToyWorld Co.Ltd.</h3>
        <hr>
        <?php if(isset($_SESSION['response'])){ ?>
        <div class="alert alert-<?= $_SESSION['res_type']; ?> 
        alert-dismissible text-center">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <b><?= $_SESSION['response']; ?></b>
        </div>
      <?php } unset($_SESSION['response']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h3 class="text-center text-info">Add Record</h3>
        <form action="actions.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <div class="form-group">
            <input type="text" name="name" value="<?= $name; ?>" class="form-control" placeholder="Enter Name" required>
          </div>
          <br>
          <div class="form-group">
            <input type="text" name="type" value="<?= $type; ?>" class="form-control" placeholder="Enter Type" required>
          </div>
          <br>
          <div class="form-group">
            <input type="text" name="made_in" value="<?= $made_in; ?>" class="form-control" placeholder="Enter Made_in" required>
          </div>
          <br>
          <div class="form-group">
            <input type="number" name="age" value="<?= $age; ?>" class="form-control" placeholder="Enter Age(under)" required>
          </div>
          <br>
          <div class="form-group">
            <input type="number" name="price" value="<?= $price; ?>" class="form-control" placeholder="Enter Price" required>
          </div>
          <br>
          <div class="form-group">
            <input type="hidden" name="oldimage" value="<?= $photo; ?>">
            <input type="file" name="image" class="custom-file">
            <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
          </div>
          <div class="form-group">
            <?php if($update==true){ ?>
              <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">  
            <?php } else{ ?>
              <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
            <?php } ?>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <?php
          $query="SELECT * FROM toydetail";
          $stmt=$conn->prepare($query);
          $stmt->execute();
          $result=$stmt->get_result();
        ?>
        <h3 class="text-center text-info">Record Present In The Database</h3>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Type</th>
              <th>Made_in</th>
              <th>Age(under)</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
        <tbody>
          <?php while($row=$result->fetch_assoc()){ ?>

          <tr>
            <td><?= $row['id']; ?></td>
            <td><img src="<?= $row['photo']; ?>" width="50"></td>
            <td><?= $row['type']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['made_in']; ?></td>
            <td><?= $row['age']; ?></td>
            <td><?= $row['price']; ?></td>
            <td>
                <a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary p-2">Details</a> |
                <a href="actions.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Do you want delete this record?);">Delete</a> |
                <a href="inde.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Edit</a>
              </td>
          </tr>
          </form>
          <?php } ?>
        </tbody>

        </table>
      </div>
    </div>
  </div>
</body>
</html>