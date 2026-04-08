<?php 
  require_once("include/dashboard.php");
  require_once("include/investment.php");
  require_once("include/transactions.php"); 
?>

<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center items-center">
  <div class="w-150 bg-slate-50 rounded-xl shadow-md">
    <header class="p-2 flex justify-end">
      <a href="index.php?page=investment" class="flex h-8 w-8 justify-center items-center text-slate-700 
      hover:text-slate-50 hover:bg-red-400 rounded-lg">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </header>

    <div class="flex flex-col p-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
      <h1 class="font-bold text-3xl text-slate-950">Перевод между своими счетами</h1>
      
      <?php if (isset($_SESSION["investment-account-refill"])): ?>
        <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
          <?= $_SESSION["investment-account-refill"] ?>
          <?php unset($_SESSION["investment-account-refill"]) ?>
        </div>
      <?php endif ?>
      
      <div class="flex flex-col">
        <form method="POST" action="include/investment-account-refill.php" class="flex flex-col gap-6 h-full">
          <span class="flex flex-col gap-2">
            <label class="font-bold text-slate-950 text-lg" for="">Откуда</label>
            <el-select id="select" name="selected" value="1" class="w-full">
              <button type="button" class="flex w-full cursor-pointer p-4 bg-slate-100 outline-none border-1 rounded-lg text-slate-700
              hover:border-blue-500 hover:bg-blue-100 placeholder:text-state-400">
                <el-selectedcontent class="flex flex-col w-full"></el-selectedcontent>
                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                  <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
              </button>

              <el-options anchor="bottom start" popover class="max-h-56 w-(--button-width) overflow-auto rounded-md hover:bg-blue-100 hover:border-blue-500 bg-slate-100 border-1 border-slate-400 shadow-md text-base outline-1 -outline-offset-1 outline-white/10 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
                <el-option value="1" class="group/option relative block cursor-default p-4 text-white select-none cursor-pointer focus:text-white focus:outline-hidden">
                  <div class="flex flex-col w-full">
                    <span class="text-left text-slate-700 text-sm">Основной счёт</span>
                    <span class="font-bold text-left text-slate-950"><?= number_format(get_user_balance($role["client_id"]), 2, ',', ' ') ?> ₽</span>
                  </div>
                  <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-500 group-not-aria-selected/option:hidden group-focus/option:text-blue-500 in-[el-selectedcontent]:hidden">
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                      <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </span>
                </el-option>
              </el-options>
            </el-select>
          </span>

          <span class="flex flex-col gap-2">
            <label class="font-bold text-slate-950 text-lg" for="">Куда</label>
            <el-select id="select" name="selected" value="1" class="w-full">
              <button type="button" class="flex w-full cursor-pointer p-4 bg-slate-100 outline-none border-1 rounded-lg text-slate-700
              hover:border-blue-500 hover:bg-blue-100 placeholder:text-state-400">
                <el-selectedcontent class="flex flex-col w-full"></el-selectedcontent>
                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                  <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
              </button>

              <el-options anchor="bottom start" popover class="max-h-56 w-(--button-width) overflow-auto rounded-md hover:bg-blue-100 hover:border-blue-500 bg-slate-100 border-1 border-slate-400 shadow-md text-base outline-1 -outline-offset-1 outline-white/10 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
                <el-option value="1" class="group/option relative block cursor-default p-4 text-white select-none cursor-pointer focus:text-white focus:outline-hidden">
                  <div class="flex flex-col w-full">
                    <span class="text-left text-slate-700 text-sm">Брокерский счет: 10123456-789</span>
                    <span class="font-bold text-left text-slate-950"><?= number_format(get_investment_account($role["client_id"]), 2, ',', ' ') ?> ₽</span>
                  </div>
                  <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-500 group-not-aria-selected/option:hidden group-focus/option:text-blue-500 in-[el-selectedcontent]:hidden">
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                      <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </span>
                </el-option>
              </el-options>
            </el-select>
          </span>

          <span class="flex flex-col gap-2">
            <label class="font-bold text-slate-950 text-lg" for="refill-value">Сумма</label>
            <input type="number" class="p-4 bg-slate-100 outline-none border-1 border-slate-600 rounded-lg 
            hover:border-blue-500 hover:bg-blue-100 cursor-pointer placeholder:text-state-400 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            placeholder="0 ₽" name="refill-value">
          </span>

          <button class="w-full text-slate-950 bg-slate-300/50 cursor-pointer text-center gap-2 p-4 
          hover:bg-blue-100 hover:text-blue-500 rounded-xl mt-auto">
            Пополнить
          </button>
        </form>
      </div>
    </div>
  </div>
</div>