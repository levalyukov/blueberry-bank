<!-- 

    

-->


<?php
    require_once("include/dashboard.php");
    require_once("include/transactions.php");

    $filter = $_GET["filter"] ?? "all";
    $active  = "cursor-pointer text-blue-500 bg-blue-100 p-3 rounded-full border-1 border-blue-500/50 capitalize flex gap-2 px-4 py-2";
    $default = "cursor-pointer px-4 py-2 rounded-full bg-slate-50 text-slate-700 border-1 border-transparent  hover:text-slate-950 hover:bg-slate-100";

    if (!$conn->query("SHOW TABLES LIKE 'transactions'")->fetch_row()) {
        create_transactions();
    }

    $transactions = array_reverse(get_user_history(get_user_accounts_id($role["client_id"])));
    $chart = get_array_transactions(get_user_accounts_id($role["client_id"]));
?>

<section class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    <header class="flex w-full justify-between items-center gap-2 mb-6">
        <span class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-slate-950 capitalize">История операций</h1>
        </span>

        <?php include_once("user-panel.php") ?>
    </header>
  
    <div class="grid grid-cols-2 gap-6">
        <div class="flex flex-col gap-6 mb-8 bg-slate-50 p-8 rounded-3xl">
            <?php if (count($transactions) > 0): ?>
                <?php for ($i = 0; $i < count($transactions); $i++): ?>
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
                        
                        rounded-xl flex justify-center items-center text-slate-50 text-xl">
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
                            <p class="text-slate-700"><?= get_type_transaction($transactions[$i][5]) ?> • 
                                <?= time_ago(strtotime($transactions[$i][6])) ?>
                            </p>
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
            <?php else: ?>
                <span class="flex justify-center items-center h-full">
                    <h1>Пусто!</h1>
                </span>
            <?php endif ?>
        </div>

        <div class="flex flex-col gap-6">
            <article class="bg-slate-50 rounded-3xl p-8 h-100">
                <canvas id="chart"></canvas>
                <script type="module">
                    import { history_chart } from "./javascript/charts.js"
                    const array = <?php echo json_encode($chart); ?>;
                    history_chart(array);
                </script>
            </article>

            <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-10">
                <span class="flex flex-col gap-2">
                    <p class="text-slate-400 uppercase py-1">Доходы за месяц</p>
                    <h1 class="text-slate-950 uppercase font-bold text-3xl"><?= number_format(get_user_month_income(get_user_accounts($role['client_id'])),2,',',' ') ?> ₽</h1>
                </span>

                <span class="flex flex-col gap-2 mt-auto">
                    <p class="text-slate-400 uppercase py-1">Расходы за месяц</p>
                    <h1 class="text-slate-950 uppercase font-bold text-3xl"><?= number_format(get_user_month_expenses(get_user_accounts($role['client_id'])),2,',',' ') ?> ₽</h1>
                </span>
            </article>
        </div>
    </div>
</section>