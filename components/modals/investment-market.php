<?php 
    require_once('include/investment/investment-market.php');

    if (!$conn->query("SHOW TABLES LIKE 'securities'")->fetch_row()) {
        create_securities();
    }

    $stocks = get_all_stocks();
    $bonds = get_all_bonds();
    $currency = get_all_currency();
    $metals = get_all_metals();
?>

<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center">
  <div class="w-300 h-[calc(100% - 5)] bg-slate-50 m-5 rounded-xl shadow-md">
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
          <?php for ($i = 0; $i < count($stocks); $i++): ?>
          <a href="index.php?page=investment&action=buy&type=stocks&id=<?= $stocks[$i][0] ?>"class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="<?= $stocks[$i][6] ?>" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950"><?= $stocks[$i][2] ?></h1>
                <p class="text-slate-500"><?= $stocks[$i][1] ?></p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format($stocks[$i][4], 2, ',', ' ');  ?> ₽</p>
              <p class="text-green-500">+0,15 ₽ (0,48 %)</p>
            </span>
          </a>
          <?php endfor ?>
        </div>

        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Облигации</h1>
          <?php for ($i = 0; $i < count($bonds); $i++): ?>
          <a href="index.php?page=investment&action=buy&type=bonds&id=<?= $bonds[$i][0] ?>" class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="<?= $bonds[$i][6] ?>" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950"><?= $bonds[$i][2] ?></h1>
                <p class="text-slate-500"><?= $bonds[$i][1] ?></p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format($bonds[$i][4], 2, ',', ' ');  ?> ₽</p>
              <p class="text-green-500">+17,48 %</p>
            </span>
          </a>
          <?php endfor ?>
        </div>
      </section>

      <section class="flex gap-10">
        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Валюта</h1>
          <?php for ($i = 0; $i < count($currency); $i++): ?>
          <a href="index.php?page=investment&action=buy&type=currency&id=<?= $currency[$i][0] ?>" class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="<?= $currency[$i][6] ?>" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950 capitalize"><?= $currency[$i][2] ?></h1>
                <p class="text-slate-500"><?= $currency[$i][1] ?></p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format($currency[$i][4], 2, ',', ' ');  ?> ₽</p>
              <!-- <p class="text-green-500">+0,32 ₽ (0,40 %)</p> -->
            </span>
          </a>
          <?php endfor ?>
        </div>

        <div class="flex flex-col w-full gap-2">
          <h1 class="uppercase text-slate-400 mb-2">Драгоценные металлы</h1>
          <?php for ($i = 0; $i < count($metals); $i++): ?>
          <a href="index.php?page=investment&action=buy&type=metals&id=<?= $metals[$i][0] ?>" class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
            <span class="flex gap-4 items-center">
              <img class="w-12 h-12 rounded-xl object-cover" src="<?= $metals[$i][6] ?>" alt="">
              <span class="flex flex-col">
                <h1 class="font-bold text-slate-950"><?= $metals[$i][2] ?></h1>
                <p class="text-slate-500"><?= $metals[$i][1] ?></p>
              </span>
            </span>

            <span class="flex flex-col text-right">
              <p class="text-slate-950"><?php echo number_format($metals[$i][4], 2, ',', ' ');  ?> ₽</p>
            </span>
          </a>
          <?php endfor ?>
        </div>
      </section>
    </div>
  </div>
</div>