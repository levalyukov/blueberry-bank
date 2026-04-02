<!-- 

    

-->

<?php 

  $action = $_GET["action"] ?? "";

?>

<?php 
  switch ($action) {
    case "market":
      include_once("modals/investment-market.php");
      break;

    case "refill":
      include_once("modals/investment-refill.php");
      break;

    case "offs":
      include_once("modals/investment-offs.php");
      break;

    case "history":
      include_once("modals/investment-history.php");
      break;
  };
?>

<section class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
  <header class="flex w-full justify-between items-center gap-2 mb-6">
    <span class="flex flex-col gap-2">
      <h1 class="text-3xl font-bold text-slate-950 capitalize">Инвестиции</h1>
    </span>

    <?php include_once("user-panel.php") ?>
  </header>

  <div class="flex gap-4">
    <div class="flex flex-col w-full gap-6">

      <div class="flex h-75 gap-6">
        <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-2 w-full">
          <p class="text-slate-400 uppercase py-1">Брокерский счет: 10123456-789</p>
          <h1 class="text-slate-950 uppercase font-bold text-3xl">4 123 012,23 ₽</h1>
          <span class="flex gap-1.5">
            <p class="text-green-500">+412 301,22 ₽ (+10,52 %)</p>
            <p class="text-slate-700">за сегодня</p>
          </span>

          <div class="flex flex-col gap-2 mt-auto">
            <span class="flex gap-2">
              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=refill">
                Пополнить
              </a>

              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=offs">
                Вывести
              </a>

              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=history">
                История
              </a>
            </span>
            <a class="cursor-pointer py-4 rounded-xl text-center text-slate-700 bg-slate-200 w-full
            hover:text-slate-950 hover:bg-slate-300 capitalize" href="index.php?page=investment&action=market">
              Витрина инвестиций
            </a>
          </div>
        </article>

        <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-2 w-full">
          <p class="text-slate-400 uppercase py-1">ИИС: 20123456-789</p>
          <h1 class="text-slate-950 uppercase font-bold text-3xl">1 623 232,23 ₽</h1>
          <span class="flex gap-1.5">
            <p class="text-green-500">+120 301,22 ₽ (+10,52 %)</p>
            <p class="text-slate-700">за сегодня</p>
          </span>

          <div class="flex flex-col gap-2 mt-auto">
            <span class="flex gap-2">
              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=refill">
                Пополнить
              </a>

              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=offs">
                Вывести
              </a>

              <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=history">
                История
              </a>
            </span>
            <a class="cursor-pointer py-4 rounded-xl text-center text-slate-700 bg-slate-200 w-full
            hover:text-slate-950 hover:bg-slate-300 capitalize" href="index.php?page=investment&action=market">
              Витрина инвестиций
            </a>
          </div>
        </article>

        <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-2 w-full">
          <canvas id="chart"></canvas>
          <script type="module">
            import { investmentChart } from "./javascript/charts.js"
            investmentChart();
          </script>
        </article>
      </div>

      <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-2">
        <h1 class="text-slate-400 uppercase">Портфель</h1>
        <section class="grid grid-cols-2 gap-6">

          <div class="flex flex-col mt-2 gap-4">
            <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Акции</h1>
            <div class="grid grid-cols-2 gap-2">
              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Сбербанк</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/rosneft--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Роснефть</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://superpressa.ru/wp-content/uploads/2023/09/sa-20.jpg" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Озон</h1>
                    <p class="text-slate-700">58 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(4500.23*58, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+51,48 %</p>
                  <p class="text-green-500">+2250,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://porti.ru/resource/img/company/logo/1.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Газпром</h1>
                    <p class="text-slate-700">20 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(140.23*20, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://static.tildacdn.com/tild3730-3931-4461-b761-323264373931/logo.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Т-Технологии</h1>
                    <p class="text-slate-700">13 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(3514.23*12, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://cdn.forbes.ru/forbes-static/new/2021/11/Company-619d3288c340a-619d3288e8cde.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">ЛУКОЙЛ</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(814.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>
            </div>
          </div>

          <div class="flex flex-col mt-2 gap-4">
            <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Облигации</h1>
            <div class="grid grid-cols-2 gap-2">
              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Сбербанк</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/rosneft--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Роснефть</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://superpressa.ru/wp-content/uploads/2023/09/sa-20.jpg" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Озон</h1>
                    <p class="text-slate-700">58 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(4500.23*58, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+51,48 %</p>
                  <p class="text-green-500">+2250,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://porti.ru/resource/img/company/logo/1.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Газпром</h1>
                    <p class="text-slate-700">20 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(140.23*20, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://static.tildacdn.com/tild3730-3931-4461-b761-323264373931/logo.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Т-Технологии</h1>
                    <p class="text-slate-700">13 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(3514.23*12, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://cdn.forbes.ru/forbes-static/new/2021/11/Company-619d3288c340a-619d3288e8cde.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">ЛУКОЙЛ</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(814.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>
            </div>
          </div>
          
          <div class="flex flex-col mt-2 gap-4">
            <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Валюта</h1>
            <div class="grid grid-cols-2 gap-2">
              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Сбербанк</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/rosneft--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Роснефть</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://superpressa.ru/wp-content/uploads/2023/09/sa-20.jpg" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Озон</h1>
                    <p class="text-slate-700">58 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(4500.23*58, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+51,48 %</p>
                  <p class="text-green-500">+2250,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://porti.ru/resource/img/company/logo/1.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Газпром</h1>
                    <p class="text-slate-700">20 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(140.23*20, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://static.tildacdn.com/tild3730-3931-4461-b761-323264373931/logo.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Т-Технологии</h1>
                    <p class="text-slate-700">13 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(3514.23*12, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://cdn.forbes.ru/forbes-static/new/2021/11/Company-619d3288c340a-619d3288e8cde.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">ЛУКОЙЛ</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(814.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>
            </div>
          </div>

          <div class="flex flex-col mt-2 gap-4">
            <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Металлы</h1>
            <div class="grid grid-cols-2 gap-2">
              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Сбербанк</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://s3-symbol-logo.tradingview.com/rosneft--600.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Роснефть</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(314.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://superpressa.ru/wp-content/uploads/2023/09/sa-20.jpg" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Озон</h1>
                    <p class="text-slate-700">58 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(4500.23*58, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+51,48 %</p>
                  <p class="text-green-500">+2250,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://porti.ru/resource/img/company/logo/1.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Газпром</h1>
                    <p class="text-slate-700">20 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(140.23*20, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://static.tildacdn.com/tild3730-3931-4461-b761-323264373931/logo.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">Т-Технологии</h1>
                    <p class="text-slate-700">13 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(3514.23*12, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>

              <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                <span class="flex gap-4 items-center">
                  <img class="object-cover w-16 h-16 rounded-2xl" src="https://cdn.forbes.ru/forbes-static/new/2021/11/Company-619d3288c340a-619d3288e8cde.png" alt="">
                  <span class="flex flex-col">
                    <h1 class="font-bold text-slate-950">ЛУКОЙЛ</h1>
                    <p class="text-slate-700">123 шт.</p>
                    <p class="text-slate-700">321,12 ₽ → 521,8 ₽</p>
                  </span>
                </span>

                <span class="flex flex-col text-right">
                  <p class="text-slate-950"><?php echo number_format(814.23*123, 2, ',', ' ');  ?> ₽</p>
                  <p class="text-green-500">+0,48 %</p>
                  <p class="text-green-500">+0,15 ₽</p>
                </span>
              </article>
            </div>
          </div>

        </section>
      </article>
    </div>
  </div>
</section>