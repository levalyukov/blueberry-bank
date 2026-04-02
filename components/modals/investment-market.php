<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center ">
  <div class="w-250 h-[calc(100% - 5)] bg-slate-50 m-5 rounded-xl shadow-md">
    <header class="p-2 flex justify-end">
      <a href="index.php?page=investment" class="flex h-8 w-8 justify-center items-center text-slate-700 
      hover:text-slate-50 hover:bg-red-400 rounded-lg">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </header>

    <div class="flex flex-col px-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] 
    [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
      <h1 class="font-bold text-3xl text-slate-950">Рынки</h1>
      <section class="flex gap-10">
        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Акции</h1>
          <?php for ($i = 1; $i < 6; $i++): ?>
          <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="https://s3-symbol-logo.tradingview.com/sberbank--600.png" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950">Сбербанк</h1>
                <p class="text-slate-500">SBER</p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format(314.23, 2, ',', ' ');  ?> ₽</p>
              <p class="text-green-500">+0,15 ₽ (0,48 %)</p>
            </span>
          </article>
          <?php endfor ?>
        </div>

        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Облигации</h1>
          <?php for ($i = 1; $i < 5; $i++): ?>
          <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="https://www.yarcom.ru/sites/default/files/styles/1600x1600/public/news/photo/2023/03/gq6LaAS-jNEwkQt.jpg.webp?itok=gH5L2ZoF" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950">Почта России, БО-002P-02</h1>
                <p class="text-slate-500">К погашению 08.06.2032</p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format(986.30, 2, ',', ' ');  ?> ₽</p>
              <p class="text-green-500">+17,48 %</p>
            </span>
          </article>
          <?php endfor ?>
        </div>
      </section>

      <section class="flex gap-10">
        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Валюта</h1>
          <?php for ($i = 1; $i < 2; $i++): ?>
          <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="assets/flags/US.svg" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950">Американский Доллар</h1>
                <p class="text-slate-500">USD</p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format(81.62	, 2, ',', ' ');  ?> ₽</p>
              <p class="text-green-500">+0,32 ₽ (0,40 %)</p>
            </span>
          </article>
          <?php endfor ?>
        </div>

        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Драгоценные металлы</h1>
          <?php for ($i = 1; $i < 2; $i++): ?>
          <article class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="https://alfaonline.servicecdn.ru/public/s3/static/investment/img_gold_bar.png" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950">Золото</h1>
                <p class="text-slate-500">Au</p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format(11737.29, 2, ',', ' ');  ?> ₽</p>
            </span>
          </article>
          <?php endfor ?>
        </div>
      </section>
    </div>
  </div>
</div>