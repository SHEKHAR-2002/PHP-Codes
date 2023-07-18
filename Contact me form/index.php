<?php

  if(empty($_POST) === false){
    $errors = array();

    $name = $_POST['name'];
    $email = $_POST['email'];  
    $subject = $_POST['subject'];
    
    if(empty($name) === true || empty($email) === true || empty($subject) === true){
      $errors[] = "Name, Email and Subject are required";
    }

    else{
      if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $errors[] = "That's not valid emial address";
      }
      if(ctype_alpha($name) === false){
        $errors[] = "Name must only contain letters";
      }
    }

    if(empty($errors) === true){
      mail('iamshekhar2506@gmail.com', 'Contact form', $subject, 'Form: ' .$email);
      header('Location: index.php?sent');
      exit();
    }

  }
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="" />
    <link rel="stylesheet" href="style.css" />
    <title>Comtact Form</title>
  </head>
  <body>
    <div class="container">
      <?php
      if(isset($_GET['sent']) === true){
        echo '<p>Thanks for Contacting us!</p>';
      } 
      else
      {
      if (empty($errors) === false){
        echo "<ul>";
        foreach($errors as $error){
          echo "<li>". $error. "</li>";
        }
        echo "</ul>";
      }
      
      ?>
      <form action="" method="post">
        <label for="fname">Full Name</label>
        <input
          type="text"
          id="fname"
          name="name"
          placeholder="Your name.."
          <?php if(isset($_POST["name"]) === true){ echo 'value = '.strip_tags($_POST["name"]).''; }?>
        />
        <label for="lname">Emial</label>
        <input
          type="text"
          id="mail"
          name="email"
          placeholder="abcd@gmail.com"
          <?php if(isset($_POST["email"]) === true){ echo 'value = '.strip_tags($_POST["email"]).''; }?>
        />
        <label for="subject">Subject</label>
        <textarea
          id="subject"
          name="subject"
          placeholder="Write something.."
          style="height: 200px"
        ><?php if(isset($_POST["subject"]) === true){ echo strip_tags($_POST["subject"]); }?></textarea>
        <input type="submit" value="Submit" />
      </form>
      <?php
       }
      ?>
    </div>
  </body>
</html>

