<style>
    <?php include 'resources\css\style.css';
    ?>
</style>
<div class="container my-5 w-50">
    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
        $message = '';
        if (in_array('unauthenticated_user', $_SESSION['errors'])) {
            $message = "Incorret Username or Password";
        }
        echo "<div class='alert alert-danger' role='alert'>
                $message
            </div>";
    } ?>
    <form method="POST" action="/login">
        <div>
        <div class="imgcontainer">
            <img src="resources\img\img_avatar.png" alt="Avatar" class="avatar">

            <!-- Email input -->
        </div>
            <label for="uname"><p> Email Address</p></label>
            <input type="email" id="email" name="email" class="form-control" />
            <!-- Password input -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" />
           
     

        <!-- Checkbox -->
        <div class="form-check">
            <label for="remember_me"> Remember me </label>
            <input type="checkbox" name="remember_me" id="remember_me" checked />

        </div>
        <!-- Submit button -->
        <button type="submit">Sign in</button>
        
    </form>
</div>
<?php
	include('resources/views/partials/footer-admin.php');
?>