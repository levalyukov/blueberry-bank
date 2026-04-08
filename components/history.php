<!-- 

    

-->


<?php
  $filter = $_GET["filter"] ?? "all";
  $active  = "cursor-pointer text-blue-500 bg-blue-100 p-3 rounded-full border-1 border-blue-500/50 capitalize flex gap-2 px-4 py-2";
  $default = "cursor-pointer px-4 py-2 rounded-full bg-slate-50 text-slate-700 border-1 border-transparent  hover:text-slate-950 hover:bg-slate-100";
?>

<section class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
  <header class="flex w-full justify-between items-center gap-2 mb-6">
    <span class="flex flex-col gap-2">
      <h1 class="text-3xl font-bold text-slate-950 capitalize">История операций</h1>
    </span>

    <?php include_once("user-panel.php") ?>
  </header>

  <!-- Filters -->

  <div class="flex flex-col gap-2 mb-6">
    <h1 class="font-bold text-lg text-slate-950">Фильтры</h1>
    <div action="" method="POST" class="flex gap-2">
      <a href="index.php?page=history&filter=all" class="<?php echo ($filter === "all") ? $active : $default ?>">Все</a>
      <a href="index.php?page=history&filter=refill" class="<?php echo ($filter === "refill") ? $active : $default ?>">Пополнения</a>
      <a href="index.php?page=history&filter=offs" class="<?php echo ($filter === "offs") ? $active : $default ?>">Списание</a>
      <a href="index.php?page=history&filter=week" class="<?php echo ($filter === "week") ? $active : $default ?>">Неделя</a>
      <a href="index.php?page=history&filter=month" class="<?php echo ($filter === "month") ? $active : $default ?>">Месяц</a>
    </div>
  </div>

  <!-- ------- -->
  
  <div class="grid grid-cols-2 gap-10">
    <div class="flex flex-col gap-8 mb-8 bg-slate-50 p-8 rounded-3xl">
      <h1 class="text-lg font-bold text-slate-950">30 марта</h1>

      <?php for ($i = 1; $i < 6; $i++): ?>
        <article class="flex justify-between items-center gap-4">
          <span class="flex gap-4">
            <span class="h-13 w-13 bg-slate-300/50 rounded-xl flex justify-center items-center text-sky-500 text-xl">
              <i class="fa-solid fa-basket-shopping"></i>
            </span>
            <span class="flex flex-col">
              <h1 class="font-bold text-slate-950 text-md">Магнит</h1>
              <p class="text-slate-700">Продукты • 2 мин. назад</p>
            </span>
          </span>
          <p class="text-slate-950">-1 123,92 ₽</p>
        </article>
      <?php endfor ?>

      <button class="text-slate-700 bg-slate-300/50 cursor-pointer flex justify-center items-center gap-2 p-4 
      hover:bg-slate-300 hover:text-slate-950 rounded-xl mt-auto">Показать еще</button>
    </div>

    <div class="flex flex-col gap-6">
      <article class="bg-slate-50 rounded-3xl p-8 h-100">
        <canvas id="chart"></canvas>
        <script type="module">
          import { initChart } from "./javascript/charts.js"
          initChart("<?php echo $filter ?>");
        </script>
      </article>

      <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-10">
        <span class="flex flex-col gap-2">
          <p class="text-slate-400 uppercase py-1">Доходы за месяц</p>
          <h1 class="text-slate-950 uppercase font-bold text-3xl">9 666 014,88 ₽</h1>
        </span>

        <span class="flex flex-col gap-2 mt-auto">
          <p class="text-slate-400 uppercase py-1">Расходы за месяц</p>
          <h1 class="text-slate-950 uppercase font-bold text-3xl">2 432 612,01 ₽</h1>
        </span>
      </article>
    </div>
  </div>
</section>