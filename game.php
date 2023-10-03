<?php
session_start();
require __DIR__ . "/view/header.php";

if (!isset($_SESSION['uname'])) {
    header("Location: app/login.php");
    exit;
}
?>

<body>

    <header></header>

    <main>
        <p><?= $_SESSION["uname"] ?></p>
        <p>Money: <span class="money_count"></span>$</p>
        <section>
            <button class="work_btn">Work</button>
            <div>
                <button class="hire_employee_btn">Hire Employee <span class="employeeCost"></span>$</button>
                <div class="employee_info">
                    <p><b>(Current employee profit: <span class="employee_profit"></span>$</b>)</p>
                </div>
            </div>
            <div>
                <button class="upgrade_work_btn">Upgrade Work <span class="workCost"></span>$</button>
                <div class="work_info">
                    <p><b>(Current work profit: <span class="work_profit"></span>$)</b></p>
                </div>
            </div>
        </section>
        <a href="app/users/logout.php"><button>Log Out</button></a>
    </main>
    <footer></footer>

    <script src="/script.js"></script>
</body>

</html>