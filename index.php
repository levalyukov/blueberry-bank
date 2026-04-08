<?php
    session_start();
    require_once("include/db.php");

    $role = $_SESSION["user"] ?? "guest";
    $page = $_GET["page"] ?? "dashboard";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="assets/icon.svg" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>    
        <?php
            if (!empty($db_error)) {
                echo "Blueberry Bank";
            } else {
                echo "Blueberry Bank | ";
                if ($role === "guest" && empty($_GET['auth'])) {
                    echo "Авторизация";
                } else if ($_GET['auth'] === "register") {
                    echo "Станьте клиентом в пару кликов!";
                } else {
                    switch ($page) {
                        case "dashboard":
                            echo "Статистика"; 
                            break;
                        case "history":
                            echo "История"; 
                            break;
                        case "investment":
                            echo "Инвестиции"; 
                            break;
                    };
                }
            };
        ?>
    </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/b1cf2338b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <script type="module" src="javascript/charts.js"></script>
</head>
    <body class="bg-slate-200/75">
        <main class="flex">

            <?php if (!empty($db_error)): ?>
            <section class="flex justify-center items-center w-full min-h-screen bg-slate-50">
                <div class="flex flex-col w-100 gap-6">
                    <span class="text-7xl text-center text-blue-500/75"><i class="fa-solid fa-heart-crack"></i></span>
                    <h1 class="text-slate-950 font-bold text-3xl text-center">Ой-Ой!</h1>
                    <p class="text-slate-700 text-center">
                        Попробуйте ещё раз сейчас или позже.
                        <br>
                        Если ошибка повторится, позвоните нам: <br>
                        8 800 555 35 35
                    </p>
                    <p class="text-slate-500 text-center">Ошибка: <?php echo $db_error ?></p>
                    <a class="cursor-pointer text-slate-700 bg-slate-200/50 p-4 text-center rounded-2xl
                    hover:bg-blue-200/50 hover:text-blue-500" 
                    onclick="javascript: window.location.reload()">Попробовать ещё раз</a>
                </div>
            </section>
            <?php else: ?>

            <?php 
                if ($role !== "guest") {
                    include_once './components/navmenu.php'; 

                    switch ($page) {
                        case 'dashboard':
                            include './components/dashboard.php'; 
                            break;
                        case 'history':
                            include './components/history.php'; 
                            break;
                        case 'investment':
                            include './components/investment.php'; 
                            break;
                        default:
                            echo "<script>window.location.href = '/index.php?page=dashboard'</script>";
                            break;
                    };
                } else {
                    include "./components/auth.php";
                };

            ?>

            <?php endif ?>
        </main>
    </body>
</html>