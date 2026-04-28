<!-- 

    

-->

<?php 
    require_once("include/dashboard.php");
    require_once("include/investment.php");
    require_once("include/transactions.php");

    if (!$conn->query("SHOW TABLES LIKE 'accounts'")->fetch_row()) {
        create_accounts();
    }

    if (!$conn->query("SHOW TABLES LIKE 'transactions'")->fetch_row()) {
        create_transactions();
    }

    $investments_securities = get_invenstment_stocks($role["client_id"]);
    $transactions = array_reverse(get_user_history(get_user_accounts_id($role["client_id"])));
    $chart = get_array_transactions(get_user_accounts_id($role["client_id"]));

    switch ($_GET["action"]) {
        case "refill":
            include_once("modals/dashboard-refill.php");
            break;
        case "transfer":
            include_once("modals/dashboard-transfer.php");
            break;        
        case "withdraw":
            include_once("modals/dashboard-withdraw.php");
            break;
    }
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
      <div class="flex flex-col h-full">
        <div class="flex justify-between">
          <span class="flex flex-col gap-2">
            <p class="text-slate-400 uppercase py-1">Доходы за месяц</p>
            <h1 class="
                <?php 
                    if (get_user_month_expenses(get_user_accounts($role['client_id'])) < 0) {
                        echo 'text-slate-500 uppercase text-2xl';
                    } else {
                        echo 'text-slate-950 uppercase font-bold text-2xl';
                    }
                ?>
            ">
                <?php 
                    if (get_user_month_income(get_user_accounts($role['client_id'])) < 0) {
                        echo '-';
                    } else {
                        echo number_format(get_user_month_income(get_user_accounts($role['client_id'])), 2, ',', ' ') . ' ₽';
                    }
                ?> 
            </h1>
          </span>

          <span class="flex flex-col gap-2 mt-auto">
            <p class="text-slate-400 uppercase py-1">Расходы за месяц</p>
            <h1 class="
                <?php 
                    if (get_user_month_expenses(get_user_accounts($role['client_id'])) < 0) {
                        echo 'text-slate-500 uppercase text-2xl';
                    } else {
                        echo 'text-slate-950 uppercase font-bold text-2xl';
                    }
                ?>
            ">
                <?php 
                    if (get_user_month_expenses(get_user_accounts($role['client_id'])) < 0) {
                        echo '-';
                    } else {
                        echo number_format(get_user_month_expenses(get_user_accounts($role['client_id'])), 2, ',', ' ') . ' ₽';
                    }
                ?>
            </h1>
            </span>
        </div>

        <div class="flex gap-2 mt-auto">
            <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center 
            hover:text-slate-950 hover:bg-slate-300" href="index.php?page=dashboard&action=refill">
                Пополнить
            </a>
            <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center 
            hover:text-slate-950 hover:bg-slate-300" href="index.php?page=dashboard&action=transfer">
                Перевести
            </a>
            <a class="cursor-pointer py-3 rounded-xl text-slate-700 bg-slate-200 w-full text-center 
            hover:text-slate-950 hover:bg-slate-300" href="index.php?page=dashboard&action=withdraw">
                Снять
            </a>
        </div>
      </div>
    </article>

    <article class="bg-slate-50 h-65 rounded-3xl p-8 flex flex-col gap-2">
        <p class="text-slate-400 uppercase py-1">Инвестиции</p>
        <?php if (has_invenstment_account((int)$role["client_id"])): ?>
            <h1 class="text-slate-950 uppercase font-bold text-3xl"><?= number_format(get_investment_account($role["client_id"]), 2, ',', ' ') ?> ₽</h1>
            <!-- <p class="text-green-500">+412 301,22 ₽ (+10,52 %)</p> -->
            <?php if (count($investments_securities) > 0): ?>
                <div class="flex mt-auto gap-2">

                    <?php for ($i = 0; $i < count($investments_securities) && $i < 6; $i++): ?>

                        <a href="index.php?page=investment" class="cursor-pointer shrink-0 hover:opacity-75 w-16 h-16">
                            <img class="rounded-2xl object-cover w-16 h-16" src="<?= get_securities_image($investments_securities[$i][2]) ?>" alt="">
                        </a>

                    <?php endfor ?>
                </div>
            <?php endif ?>
        <?php else: ?>
            <a href="index.php?page=investment" class="w-full border-1 border-slate-400 rounded-xl p-4 mt-auto text-center text-slate-700 
            bg-slate-100 hover:bg-blue-100 hover:border-blue-500 hover:text-blue-500">
                Открыть брокерский счёт
            </a>
        <?php endif ?>
    </article>

    <article class="col-span-2 h-full bg-slate-50 rounded-3xl p-8 flex flex-col gap-2">
        <canvas id="chart"></canvas>
        <script type="module">
            import { dashboard_chart } from "./javascript/charts.js"
            const array = <?php echo json_encode($chart); ?>;
            dashboard_chart(array);
        </script>
    </article>

    <article class="bg-slate-50  rounded-3xl p-8 flex flex-col gap-2">
        <p class="text-slate-950 font-bold capitalize text-xl py-1 mb-5">Последние операции</p>
        <div class="flex flex-col gap-8 h-full">

        <?php if (count($transactions) > 0): ?>

            <?php for ($i = 0; $i < $transactions[$i] && $i < 4; $i++): ?>
            <article class="flex justify-between items-center gap-4">
                <span class="flex gap-4">
                    <span class="h-13 w-13 
                    
                    <?php
                    
                        if (strpos($transactions[$i][5], "investment") === 0) {
                            echo "bg-red-400";
                        } else if (strpos($transactions[$i][5], "transfer") === 0) {
                            echo "bg-blue-400"; 
                        } else if (strpos($transactions[$i][5], "replenishment") === 0) {
                            echo "bg-green-400"; 
                        } else if (strpos($transactions[$i][5], "withdrawal") === 0) {
                                echo "bg-amber-400"; 
                        }
                    
                    ?> 
                    
                    rounded-2xl flex justify-center items-center text-slate-50 text-xl">
                        <i class="
                        
                        <?php 
                        
                            if (strpos($transactions[$i][5], "investment") === 0) {
                                echo "fa-solid fa-money-bill-trend-up";
                            } else if (strpos($transactions[$i][5], "transfer") === 0) {
                                echo "fa-solid fa-money-bill-transfer"; 
                            } else if (strpos($transactions[$i][5], "replenishment") === 0) {
                                echo "fa-solid fa-plus"; 
                            } else if (strpos($transactions[$i][5], "withdrawal") === 0) {
                                    echo "fa-solid fa-arrow-up";
                            }

                        ?>
                        "
                        ></i>
                    </span>
                    <span class="flex flex-col">
                        <h1 class="font-bold text-slate-950 text-md"><?= $transactions[$i][3] ?></h1>
                        <p class="text-slate-700"><?= get_type_transaction($transactions[$i][5]) ?> • <?= time_ago(strtotime($transactions[$i][6])) ?></p>
                    </span>
                </span>
                <p class="
                
                <?=
                    (
                        strpos($transactions[$i][5], 'replenishment') === 0 ||
                        strpos($transactions[$i][5], 'investment-sale') === 0 ||
                        (
                            $transactions[$i][5] === "transfer" && 
                            in_array($transactions[$i][2], get_user_accounts($role["client_id"]))
                        )
                    ) 
                    ? 'text-green-500' : 'text-slate-700'
                ?>
                text-nowrap
                ">
                
                <?=
                    (
                        strpos($transactions[$i][5], 'replenishment') === 0 ||
                        strpos($transactions[$i][5], 'investment-sale') === 0 ||
                        (
                            $transactions[$i][5] === "transfer" && 
                            in_array($transactions[$i][2], get_user_accounts($role["client_id"]))
                        )
                    )
                    ? '+' : '-'
                ?><?= number_format($transactions[$i][4], 2, ',', ' ') ?> ₽</p>
            </article>
            <?php endfor ?>

            <?php if (count($transactions) > 4): ?>
                <a href="index.php?page=history" class="text-blue-500 cursor-pointer flex justify-center items-center gap-2 p-4 hover:bg-blue-100 rounded-xl mt-auto">
                    Все операции <span><i class="fa-solid fa-arrow-right"></i></span>
                </a>
            <?php endif ?>

        <?php else: ?>

            <div class="flex flex-col justify-center items-center h-full gap-4">
                <p class="text-slate-700">Пусто!</p>
            </div>

        <?php endif ?>
        
      </div>
    </article>
  </div>

</section>