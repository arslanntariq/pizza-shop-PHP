<?php
include('config/db_connect.php');

$email = $title = $indgredints = ''; // Corrected variable name
$errors = array('email' => '', 'title' => '', 'indgredints' => ''); // Corrected variable name

if (isset($_POST['submit']))
 {
    // check email
    if (empty($_POST['email']))
     {
        $errors['email'] = 'An email is required';
    }
     else
     {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $errors['email'] = 'Email must be a valid email address';
        }
    }
// check title
    if (empty($_POST['title']))
     {
        $errors['title'] = 'A title is required';
    }
     else 
    {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title))
         {
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    // check indgredints
    if (empty($_POST['indgredints']))
     { // Corrected variable name
        $errors['indgredints'] = 'At least one indgredints is required';
    }
     else
      {
        $indgredints = $_POST['indgredints']; // Corrected variable name
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $indgredints)) { // Corrected variable name
            $errors['indgredints'] = 'Indgredints must be a comma-separated list'; // Corrected variable name
        }
    }

    if (array_filter($errors)) {
        //echo 'errors in form';
    } else {
        // escape sql chars
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $indgredints = mysqli_real_escape_string($conn, $_POST['indgredints']); // Corrected variable name

        // create sql
        $sql = "INSERT INTO pizzas(title,email,indgredints) VALUES('$title','$email','$indgredints')"; // Corrected column name

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
} // end POST check
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Your Email</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Pizza Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients (comma separated)</label> <!-- Corrected variable name -->
        <input type="text" name="indgredints" value="<?php echo htmlspecialchars($indgredints) ?>"> 
        <div class="red-text"><?php echo $errors['indgredints']; ?></div> 
        <div class="center">
            <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>
