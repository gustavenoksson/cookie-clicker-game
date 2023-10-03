<?php
require __DIR__ . "/view/header.php";

session_start();

?>

<body>
    <main>
        <h1>MANAGÉER</h1>
        <section class="formSection">
            <p>Login</p>
            <form action="/app/users/login.php" method="post" class="form">
                <label for="uname">User Name</label>
                <input type="text" name="uname" placeholder="User Name" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
                </label>
                <button type="submit">Login</button>
            </form>
            <p><a href="create.php">Create Account</a></p>
            <?php if (isset($_SESSION["login_error"])) :
                echo $_SESSION["login_error"];
                unset($_SESSION["login_error"]);
            endif; ?>
        </section>
    </main>
    <footer></footer>
    <script src="script.js"></script>
</body>