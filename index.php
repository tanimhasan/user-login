<?php
session_start();

// variable declaration
$username = "";
$email    = "";
$msg = "";
$_SESSION['success'] = "";

// connect to databases
$db = mysqli_connect('localhost', 'root', '', 'login');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        $msg =  "Username is required";
    }
    if (empty($password)) {
        $msg =  "Password is required";
    }

    if ($msg == 0) {
        $password = $password;
        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: home.php');
        }else {
            $msg = "<span style='color: red; font-size: 16px;'>Wrong username/password combination!</span>";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
h2{text-align: center;}
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}


.container {
  padding: 16px;
  width: 500px;
  height: 500px;
  margin: 0 auto;
}

</style>
</head>
<body>
<div class="container">
<h2>Login Form</h2><hr><br>
<?php echo $msg;?>



<form action="" method="post">


  <div class="form"><br>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="login">Login</button>
  </div>

  
</form>
</div>

</body>
</html>