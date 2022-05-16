

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
	<title>Registration form</title>
	<style type="text/css">
		.error {
			font-size: 15px;
			color: red;
		}
	</style>
</head>

<body>
	<?php

	$firstnameErr = $lastnameErr = $phoneErr = $emailErr = $passwordErr =$genderErr  = NULL;
	$firstname = $lastname  = $phone = $email = $password = $gender = NULL;

	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["firstname"])) {
			$firstnameErr = "First name is required";
			$flag = false;
		} else {
			$firstname = test_input($_POST["firstname"]);
             // check if name only contains letters and whitespace
             if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
                $firstnameErr = "Only letters and white space allowed";
            }
		}

		if (empty($_POST["lastname"])) {
			$lastnameErr = "Last name is required";
			$flag = false;
		} else {
			$lastname = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
                $lastnameErr = "Only letters and white space allowed";
            }
		}

		if (empty($_POST["phone"])) {
			$flag = false;
		} else {
			$phone = test_input($_POST["phone"]);
           // if (!preg_match("/^[+94[7-9]{2}-[0-9]{3}-[0-9]{4}']*$/",$phone)) {
             //   $phoneErr = "must be 10 numbers";
            //}
		}

		if (empty($_POST["email"])) {
			
			$flag = false;
		} else {
			$email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
           
		}
        if (empty($_POST["password"])) {
			
			$flag = false;
		} else {
			$password = test_input($_POST["password"]);
             
		}
        if (empty($_POST["gender"])) {
			
			$flag = false;
		} else {
			$gender = test_input($_POST["gender"]);
       }    
      


	//	$gender = $_POST["gender"];         (!preg_match("?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}")
	//	$state = $_POST["state"];             "+94[7-9]{2}-[0-9]{3}-[0-9]{4}"
   // if (!preg_match("?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}",$phone)){
  //      $passwordErr = "Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
  //  }  

		// submit form if validated successfully
		if ($flag) {

			$conn = new mysqli('localhost', "root", "", "formphp");

			if ($conn->connect_error) {
				die("connection failed error: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO validetable (firstname,lastname,phone, email,password,gender) VALUES('$firstname', '$lastname', '$phone', '$email','$password','$gender') ";

		

			// execute sql insert
			if ($conn->query($sql) === TRUE) {
				echo "<script> alert('data saved successfully');</script>";
			}
		}

		$sql=mysqli_query($conn,"SELECT* from validetable ORDER by id DESC");

	}
	
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	 
	?>
	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div class="card pt-2 mx-auto" style="max-width: 30rem; background-color:blue;">
			<div class="card-header" style="font-size: 25px;
			font-style: italic; text-align:center;">
				<header>Registration Form</header>
			</div>
			<div class="card-body">
				<div class="card-text mb-2">
					First Name* : <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?= $firstname; ?>">
					<span class="error"> <?= $firstnameErr; ?></span>
				</div>
				<div class="card-text mb-2">
					Last Name* : <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?= $lastname; ?>">
					<span class="error"> <?= $lastnameErr; ?></span>
				</div>
				<div class="card-text mb-2">
					Phone <small>(optional)</small> : <input type="text" name="phone" class="form-control" placeholder="Please enter your phone" value="<?= $phone; ?>">
					<span class="error"> <?= $phoneErr; ?></span>
				</div>
				<div class="card-text mb-2">
					Email-id <small>(optional)</small> : <input type="text" name="email" class="form-control" placeholder="Please enter your Email id" value="<?= $email; ?>">
					<span class="error"> <?= $emailErr; ?></span>
				</div>
                <div class="card-text mb-2">
					Password: <input type="text" name="password" class="form-control" placeholder="Please enter your password" value="<?= $password; ?>">
					<span class="error"> <?= $passwordErr; ?></span>
				</div>
                <div class="card-text mb-2">

					 Gender: 
					   <input type="radio" name="gender"  value= <?php if( $gender  = "Female") echo "male"; ?> /> Male
					   <input type="radio" name="gender"   value= <?php if( $gender = "Female") echo "Female"; ?> />Female
					   <input type="radio" name="gender"   value= <?php if( $gender = "Female") echo "Others"; ?> />Others
					   <span class="error"> <?= $genderErr; ?></span>    
                   
                </div>      

                
				
			</div>
			<div class="card-footer mb-2 btn-lg">
				<input class="button btn btn-primary" type="submit" name="button" style="margin-left:200px;" >
				
			</div>
			
		</div>
	</form><br><br><br><br><br>
	<table border="2">
     <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>mobile</th>
        <th>Email</th>
		
     </tr>
    <?php
   
	
    while ($res = mysqli_fetch_array($sql)){

        echo "<tr>";
        echo "<td>".$res['firstname']."</td>";
        echo "<td>".$res['lastname']."</td>";
        echo "<td>".$res['phone']."</td>";
        echo "<td>".$res['email']."</>";
		//echo "<td>".$res['gender']."</>";
        echo "<tr>";
    }


    ?>
     </table>



</body>

</html>
