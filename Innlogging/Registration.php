 <?php
    //CSRF
    /* session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
} */
    ?>

 <!DOCTYPE html>
 <html lang="nb">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../stylesheets/Registration.css?v=1.0" type="text/css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
 </head>
 <title>Registrer Deg</title>

 <body>

     <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
         <span></span> <span></span> <span></span> <span></span> <span></span>

         <div class="signin">
             <div class="content">
                 <h2>Registration</h2>
                 <div class="form">
                     <form action="signup.php" method="post">
                         <div class="inputBox">
                             <input type="text" name="username" required> <i>Username</i>

                         </div> <br>
                         <div class="inputBox">
                             <input type="password" name="password" required> <i>Password</i>

                         </div> <br>
                         <div class="inputBox">
                             <input type="password" name="confirm_password" required> <i>Confirm Password</i>

                         </div>
                         <br>
                         <div class="links"> <br> <a href="Login.php">Log in</a> </div>

                         <!-- <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> -->

                         <div class="inputBox"> <input type="submit" value="Register"> </div>
                     </form>
                 </div>
             </div>
         </div>

     </section>

 </body>

 </html>