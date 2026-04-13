<?php
    require_once("include/dashboard.php");
    require_once("include/investment-buy.php");

    $accounts = get_user_accounts($role["client_id"]);
    $price = get_price($_GET["id"]);

?>

<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center items-center">
  <div class="w-150 bg-slate-50 m-5 rounded-xl shadow-md">
    <header class="p-2 flex justify-end">
      <a href="index.php?page=investment&action=market" class="flex h-8 w-8 justify-center items-center text-slate-700 
      hover:text-slate-50 hover:bg-red-400 rounded-lg">
        <i class="fa-solid fa-xmark"></i>
      </a>
    </header>

    <div class="flex flex-col px-8 pb-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        <h1 class="font-bold text-3xl text-slate-950">Покупка <?= get_type_transaction() . " " . get_name($_GET["id"]) ?></h1>

        <?php if (isset($_SESSION["transaction-error"])): ?>
          <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
            <?= $_SESSION["transaction-error"] ?>
            <?php unset($_SESSION["transaction-error"]) ?>
          </div>
        <?php endif ?>

        <form action="include/investment-buy.php?action=<?= $_GET["action"] ?>&id=<?= $_GET["id"] ?>&type=<?= $_GET["type"] ?>" method="POST" class="flex flex-col gap-6 h-full">
            <span class="flex flex-col gap-2">
              <label for="count" class="font-bold text-slate-950 text-lg">Счёт списания</label>
              <el-select id="select" name="account_id" value="1" class="w-full">
                <button type="button" class="flex w-full cursor-pointer p-4 bg-slate-100 outline-none border-1 rounded-lg text-slate-700
                hover:border-blue-500 hover:bg-blue-100 placeholder:text-state-400">
                    <el-selectedcontent class="flex flex-col w-full"></el-selectedcontent>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                    <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </button>

                <el-options anchor="bottom start" popover class="max-h-56 w-(--button-width) overflow-auto rounded-md bg-slate-100 border-1 border-slate-400 shadow-md text-base outline-1 -outline-offset-1 outline-white/10 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
                    <?php for ($i = 0; $i < count($accounts); $i++): ?>

                    <el-option value="<?= $accounts[$i][0] ?>" class="group/option relative hover:bg-blue-100 hover:border-blue-500 block cursor-default py-4 pr-9 pl-4 text-white select-none cursor-pointer focus:text-white focus:outline-hidden">
                        <div class="flex flex-col w-full">
                            <span class="text-left text-slate-700 text-sm"><?= $accounts[$i][3] ?></span>
                            <span class="font-bold text-left text-slate-950"><?= number_format($accounts[$i][2], 2, ',', ' ') ?> ₽</span>
                        </div>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-500 group-not-aria-selected/option:hidden group-focus/option:text-blue-500 in-[el-selectedcontent]:hidden">
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </span>
                    </el-option>

                    <?php endfor ?>
                </el-options>
              </el-select>
            </span>

          <span class="flex flex-col gap-2">
            <label class="font-bold text-slate-950 text-lg flex items-center gap-2" for="">Количество <p id="securities-price" class="text-sm font-normal text-slate-700">(цена: 0 ₽)</p></label>
            <input require id="securities-value" type="number" class="p-4 bg-slate-100 outline-none border-1 border-slate-600 rounded-lg 
            hover:border-blue-500 hover:bg-blue-100 cursor-pointer placeholder:text-state-400 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
            placeholder="Введите количество ценных бумаг для приобретения" min="1" value="1" name="value">
          </span>

          <button type="submit" class="w-full text-slate-950 bg-slate-300/50 cursor-pointer text-center gap-2 p-4 
          hover:bg-blue-100 hover:text-blue-500 rounded-xl mt-auto">
            Подать заявку
          </button>
        </form>


        <script>
            const formatter = new Intl.NumberFormat('ru-RU', {style: 'currency', currency: 'RUB'})
            const input = document.getElementById("securities-value");
            const price = document.getElementById("securities-price");
            const valuation = '<?= $price ?>'

            if (input) {
                if (price) {
                    price.innerHTML = `(цена: ${formatter.format(input.value*valuation)})`
                    input.addEventListener("input", () => {
                        
                        let value; 
                        if (input.value > 0) {
                          value = input.value*valuation;
                        } else {
                          value = 0;
                        };

                        price.innerHTML = `(цена: ${formatter.format(value)})`
                    })
                }
            }
        </script>
    </div>
  </div>
</div>