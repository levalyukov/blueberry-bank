<!-- 

    

-->


<?php
    $subscribe = !false;
    $page = $_GET['page'] ?? 'dashboard';
    $active = "cursor-pointer text-blue-500 bg-blue-100 p-3 rounded-xl capitalize flex gap-2 px-4";
    $default = "cursor-pointer text-slate-700 p-3 rounded-xl capitalize flex gap-2 px-4 hover:bg-slate-200/75 hover:text-slate-950 text-md";
?>

<aside id="navmenu" class="h-screen w-xs bg-slate-50 px-6 py-8 border-r-1 border-slate-300 flex flex-col shrink-0">
    <header class="text-slate-950 flex justify-between items-center mb-12">
        <img src="assets/logotype.svg" alt="logotype.svg">
        <!-- <button class="cursor-pointer h-8 w-8 flex justify-center items-center rounded-md text-slate-
         hover:bg-slate-200/75 hover:text-slate-950 shrink-0" onclick="navmenu()">
            <span class="flex justify-center items-center"><i class="fa-solid fa-xmark"></i></span>
        </button> -->
    </header>

    <nav class="flex gap-4 flex-col w-full">
        <a href="index.php?page=dashboard" class="<?php echo ($page === "dashboard") ? $active : $default ?>">
            <span class="w-6 h-6"><i class="fa-regular fa-chart-bar"></i></span> Статистика
        </a>

        <a href="index.php?page=history" class="<?php echo ($page === "history") ? $active : $default ?>">
            <span class="w-6 h-6"><i class="fa-solid fa-clock-rotate-left"></i></span> История
        </a>

        <a href="index.php?page=investment" class="<?php echo ($page === "investment") ? $active : $default ?>">
            <span class="w-6 h-6"><i class="fa-solid fa-money-bill-trend-up"></i></span> Инвестиции
        </a>
    </nav>

    <?php 
        if (!$subscribe):
    ?>

    <article class="bg-slate-900 rounded-2xl p-4 flex gap-2 flex-col mt-auto">
        <h1 class="text-slate-50 text-xl font-bold">Премиум подписка</h1>
        <p class="text-slate-300 mb-4">Получайте советы по инвестициям и вкладам.</p>
        <button class="text-slate-50 cursor-pointer bg-gradient-to-r from-cyan-500 via-blue-500 to-emerald-400 
        py-3 rounded-xl font-medium text-center">
        Подписаться
        </button>
    </article>

    <?php endif ?>
</aside>