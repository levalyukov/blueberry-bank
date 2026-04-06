<!-- 

    

-->

<?php 

  require_once("include/dashboard.php");
?>


<section class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
  <header class="flex w-full justify-between items-center gap-2 mb-6">
    <span class="flex flex-col gap-2">
      <h1 class="text-3xl font-bold text-slate-950">Доброе утро, <?= $role["name"] ?>!</h1>
    </span>

    <?php include_once("user-panel.php") ?>
  </header>

  <!-- Dashboard -->

  <div class="grid grid-cols-[repeat(auto-fit,minmax(450px,1fr))] gap-6">
    <article id="total-balance" class="bg-slate-50 h-65 rounded-3xl p-8">
      <div class="flex flex-col h-full">
        <span class="flex flex-col gap-2">
          <span class="flex justify-between">
            <h1 class="text-slate-400 uppercase py-1">Общий баланс</h1>
          </span>

          <h1 class="
          <?php 
            if (get_user_balance((int)$role["client_id"]) >= 0) {
              echo "text-slate-950 uppercase font-bold text-3xl";
            } else {
              echo "text-red-500 uppercase font-bold text-3xl";
            }; 
          ?>"><?= number_format(get_user_balance((int)$role["client_id"]), 2, ',', ' ') ?> ₽</h1>
        </span>

        <span class="flex flex-col mt-auto gap-4">
          <span class="flex justify-between items-center">
            <p class="text-slate-400">**** **** **** 4567</p>
            <p class="text-slate-400">01/38</p>
          </span>
        </span>
      </div>
    </article>

    <article class="bg-slate-50 h-65 rounded-3xl p-8 flex flex-col">
      <span class="flex flex-col gap-2">
        <p class="text-slate-400 uppercase py-1">Доходы за месяц</p>
        <h1 class="
            <?php 
              if (get_user_month_expenses() < 0) {
                echo 'text-slate-500 uppercase text-3xl';
              } else {
                echo 'text-slate-950 uppercase font-bold text-3xl';
              }
            ?>
        ">
          <?php 
            if (get_user_month_income() < 0) {
              echo '-';
            } else {
              echo number_format(get_user_month_income(), 2, ',', ' ') . ' ₽';
            }
          ?> 
        </h1>
      </span>

      <span class="flex flex-col gap-2 mt-auto">
        <p class="text-slate-400 uppercase py-1">Расходы за месяц</p>
        <h1 class="
            <?php 
              if (get_user_month_expenses() < 0) {
                echo 'text-slate-500 uppercase text-3xl';
              } else {
                echo 'text-slate-950 uppercase font-bold text-3xl';
              }
            ?>
        ">
          <?php 
            if (get_user_month_expenses() < 0) {
              echo '-';
            } else {
              echo number_format(get_user_month_expenses(), 2, ',', ' ') . ' ₽';
            }
          ?>
      </h1>
      </span>
    </article>

    <article class="bg-slate-50 h-65 rounded-3xl p-8 flex flex-col gap-2">
      <p class="text-slate-400 uppercase py-1">Инвестиции</p>
      <?php if (has_invenstment_account((int)$role["client_id"])): ?>
        <h1 class="text-slate-950 uppercase font-bold text-3xl">4 123 012,23 ₽</h1>
        <p class="text-green-500">+412 301,22 ₽ (+10,52 %)</p>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(32px,1fr))] mt-auto gap-1">
          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://media.licdn.com/dms/image/v2/C4D0BAQGtaNDEUk4FSQ/company-logo_200_200/company-logo_200_200/0/1630556941344/alfa_bank_logo?e=2147483647&v=beta&t=tk5ylRjvC9jx6kHTTkv69QBPXjHV8jsEsGaHnH-dPXw" alt="">
          </a>

          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://s3-symbol-logo.tradingview.com/rosneft--600.png" alt="">
          </a>

          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://superpressa.ru/wp-content/uploads/2023/09/sa-20.jpg" alt="">
          </a>

          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://porti.ru/resource/img/company/logo/1.png" alt="">
          </a>

          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://static.tildacdn.com/tild3730-3931-4461-b761-323264373931/logo.png" alt="">
          </a>

          <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75">
            <img class="rounded-2xl object-cover w-16 h-16" src="https://cdn.forbes.ru/forbes-static/new/2021/11/Company-619d3288c340a-619d3288e8cde.png" alt="">
          </a>
        </div>
      <?php else: ?>
        <a href="" class="w-full border-1 border-slate-400 rounded-md p-4 text-center text-slate-700 
        bg-slate-100 hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500">
          Открыть брокерский счёт
        </a>
    </article>

    <?php endif ?>

    <article class="col-span-2 h-full bg-slate-50 rounded-3xl p-8 flex flex-col gap-2">
      <canvas id="myChart"></canvas>
    </article>

    <article class="bg-slate-50  rounded-3xl p-8 flex flex-col gap-2">
      <p class="text-slate-950 font-bold capitalize text-xl py-1 mb-5">Последние операции</p>
      <div class="flex flex-col gap-8 h-full">

        <?php if (count(get_user_last_history((int)$role['client_id'])) > 0): ?>

          <?php for ($i = 0; $i < 4; $i++): ?>
          <article class="flex justify-between items-center gap-4">
            <span class="flex gap-4">
              <span class="h-13 w-13 bg-slate-200 rounded-xl flex justify-center items-center text-green-500 text-xl">
                <i class="fa-solid fa-money-bill-transfer"></i>
              </span>
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950 text-md">Василий А.</h1>
                <p class="text-slate-700">Перевод • 34 мин. назад</p>
              </span>
            </span>
            <p class="text-green-500">+5 213,52 ₽</p>
          </article>
          <?php endfor ?>

        <a href="index.php?page=history" class="text-blue-500 cursor-pointer flex justify-center items-center gap-2 p-4 hover:bg-blue-100 rounded-xl mt-auto">
          Все операции <span><i class="fa-solid fa-arrow-right"></i></span>
        </a>

        <?php else: ?>

          <div class="flex flex-col justify-center items-center h-full gap-4">
            <p class="text-slate-700">Пусто!</p>
          </div>

        <?php endif ?>
        
      </div>
    </article>
  </div>

</section>

<script>
  new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
      labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь"],
      datasets: [{
        label: 'Траты за месяц',
        data: [432612.01, 1432612.01, 5432612.01, 732612.01, 3432612.01, 1432612.01],
        borderRadius: 10,
        backgroundColor: [
          'rgba(255, 99, 132,  0.5)',
          'rgba(255, 159, 64,  0.5)',
          'rgba(255, 205, 86,  0.5)',
          'rgba(75, 192, 192,  0.5)',
          'rgba(54, 162, 235,  0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(201, 203, 207, 0.5)'
        ],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>