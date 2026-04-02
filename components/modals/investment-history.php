<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center items-center">
  <div class="w-175 h-175 bg-slate-50 m-5 rounded-xl shadow-md">
    <header class="p-2 flex justify-end">
      <a href="index.php?page=investment" class="flex h-8 w-8 justify-center items-center text-slate-700 
      hover:text-slate-50 hover:bg-red-400 rounded-lg">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </header>

    <div class="flex flex-col px-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
      <h1 class="font-bold text-3xl text-slate-950 capitalize">История операций</h1>
      <div class="flex flex-col gap-2">

        <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
          <span class="flex gap-4 items-center">
            <span class="bg-slate-950 w-12 h-12 rounded-xl flex justify-center items-center">
              <i class="fa-solid fa-percent text-slate-50 text-3xl"></i>
            </span>
            <span class="flex flex-col">
              <h1 class="font-bold text-slate-950">Комиссия брокера за сделку Сбербанк</h1>
            </span>
          </span>

          <span class="flex flex-col text-right">
            <p class="text-slate-950">-<?php echo number_format((314.23*(30*6))*(3/100), 2, ',', ' ');  ?> ₽</p>
          </span>
        </article>

        <?php for ($i = 1; $i < 8; $i++): ?>
        <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
          <span class="flex gap-4 items-center">
            <img class="w-12 h-12 rounded-xl object-cover" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
            <span class="flex flex-col">
              <h1 class="font-bold text-slate-950">Покупка Сбербанк</h1>
              <p class="text-slate-700">30 акций</p>
            </span>
          </span>

          <span class="flex flex-col text-right">
            <p class="text-slate-950"><?php echo number_format(-314.23*30, 2, ',', ' ');  ?> ₽</p>
            <p class="text-slate-700">314,23</p>
          </span>
        </article>
        <?php endfor ?>

        <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
          <span class="flex gap-4 items-center">
            <span class="bg-slate-950 w-12 h-12 rounded-xl flex justify-center items-center">
              <i class="fa-solid fa-up-long text-slate-50 text-3xl"></i>
            </span>
            <span class="flex flex-col">
              <h1 class="font-bold text-slate-950">Вывод с брокерского счета</h1>
            </span>
          </span>

          <span class="flex flex-col text-right">
            <p class="text-slate-950">-<?php echo number_format(52*52, 2, ',', ' ');  ?> ₽</p>
          </span>
        </article>

        <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
          <span class="flex gap-4 items-center">
            <span class="bg-slate-950 w-12 h-12 rounded-xl flex justify-center items-center">
              <i class="fa-solid fa-down-long text-slate-50 text-3xl"></i>
            </span>
            <span class="flex flex-col">
              <h1 class="font-bold text-slate-950">Пополнение брокерского счета</h1>
            </span>
          </span>

          <span class="flex flex-col text-right">
            <p class="text-green-500">+<?php echo number_format(314.23*30, 2, ',', ' ');  ?> ₽</p>
          </span>
        </article>
      </div>
    </div>
  </div>
</div>