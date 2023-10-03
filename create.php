<?php
require __DIR__ . "/view/header.php";

session_start();

?>

<body>
    <main>
        <section class="formSection">
            <p>Create Account</p>
            <form action="/app/users/register.php" method="post" class="form">
                <label for="uname">User Name</label>
                <input type="text" name="uname" placeholder="User Name" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </label>
                <button type="submit">Create Account</button>
            </form>
            <p><a href="index.php">Back to login page</a></p>
            <?php if (isset($_SESSION["register_error"])) :
                echo $_SESSION["register_error"];
                unset($_SESSION["register_error"]);
            endif; ?>
        </section>
    </main>
</body>