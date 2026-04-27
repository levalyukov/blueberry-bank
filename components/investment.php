<!-- 

    

-->

<?php
    $action = $_GET["action"] ?? "";
    require_once("include/investment.php");

    $portfolio = get_investment_portfolio($role["client_id"]);
    $stocks = get_invenstment_stocks($role["client_id"]);
    $bonds = get_invenstment_bonds($role["client_id"]);
    $currency = get_invenstment_currency($role["client_id"]);
    $metals = get_invenstment_metals($role["client_id"]);

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

        case "buy":
            include_once("modals/investment-buy.php");
            break;

        case "sell":
            include_once("modals/investment-sell.php");
            break;
    }
?>

<section
    class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    <header class="flex w-full justify-between items-center gap-2 mb-6">
        <span class="flex flex-col gap-2">
            <h1 class="text-3xl font-bold text-slate-950 capitalize">
                <?php
                    if (has_invenstment_account((int) $role["client_id"])) {
                        echo "Инвестиции";
                    }
                ?>
            </h1>
        </span>

        <?php include_once("user-panel.php") ?>
    </header>

    <div class="flex gap-4">
        <div class="flex flex-col w-full gap-6">
            <?php if (has_invenstment_account((int)$role["client_id"]) == true): ?>
                <div class="flex h-75 gap-6">
                    <article class="bg-slate-50 rounded-3xl p-8 flex flex-col gap-2 w-full">
                        <p class="text-slate-400 uppercase py-1">Брокерский счет: 10123456-789</p>
                        <h1 class="text-slate-950 uppercase font-bold text-3xl">
                            <?= number_format(get_investment_balance($role["client_id"]), 2, ',', ' ') ?> ₽
                        </h1>
                        </span>

                        <div class="flex flex-col gap-2 mt-auto">
                            <span class="flex gap-2">
                                <a class="cursor-pointer py-4 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=refill">
                                    Пополнить
                                </a>

                                <a class="cursor-pointer py-4 rounded-xl text-slate-700 bg-slate-200 w-full text-center
              hover:text-slate-950 hover:bg-slate-300" href="index.php?page=investment&action=offs">
                                    Вывести
                                </a>

                                <a class="cursor-pointer py-4 rounded-xl text-slate-700 bg-slate-200 w-full text-center
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
                        <?php if (count($stocks) > 0): ?>
                            <div class="flex flex-col mt-2 gap-4">
                                <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Акции</h1>
                                <div class="grid grid-cols-2 gap-2">
                                    <?php for ($i = 0; $i < count($stocks); $i++): ?>

                                        <a href="index.php?page=investment&action=sell&type=stocks&id=<?= $stocks[$i][2] ?>"
                                            class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                                            <span class="flex gap-4 items-center">
                                                <img class="object-cover w-14 h-14 rounded-2xl"
                                                    src="<?= get_securities_image($stocks[$i][2]) ?>" alt="">
                                                <span class="flex flex-col">
                                                    <h1 class="font-bold text-slate-950 text-sm capitalize capitalize">
                                                        <?= get_securities_name($stocks[$i][2]) ?>
                                                    </h1>
                                                    <p class="text-slate-700 text-sm"><?= $stocks[$i][5] ?> шт.</p>
                                                    <p class="text-slate-700 text-sm">
                                                        <?= number_format($stocks[$i][3], 2, ',', ' ') ?> ₽ →
                                                        <?= number_format($stocks[$i][4], 2, ',', ' ') ?> ₽
                                                    </p>
                                                </span>
                                            </span>

                                            <span class="flex flex-col text-right">
                                                <p class="text-slate-950 text-sm">
                                                    <?php echo number_format($stocks[$i][3] * $stocks[$i][5], 2, ',', ' '); ?> ₽
                                                </p>

                                                <p class="
                        
                        <?php
                        if (abs(get_investment_profit_percent($role["client_id"], $stocks[$i][0])) < 0.0) {
                            echo 'text-red-500';
                        } else if (abs(get_investment_profit_percent($role["client_id"], $stocks[$i][0])) > 0.0) {
                            echo 'text-green-500';
                        } else {
                            echo 'text-slate-500';
                        }
                        ?>
                        
                        text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_percent($role["client_id"], $stocks[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_percent($role["client_id"], $stocks[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_percent($role["client_id"], $stocks[$i][0]), 2, ',', ' ') ?>
                                                    %
                                                </p>

                                                <p class="
                        
                        <?php
                        if (abs(get_investment_profit_value($role["client_id"], $stocks[$i][0])) < 0.0) {
                            echo 'text-red-500';
                        } else if (abs(get_investment_profit_value($role["client_id"], $stocks[$i][0])) > 0.0) {
                            echo 'text-green-500';
                        } else {
                            echo 'text-slate-500';
                        }
                        ?>
                        
                        text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_value($role["client_id"], $stocks[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_value($role["client_id"], $stocks[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_value($role["client_id"], $stocks[$i][0]), 2, ',', ' ') ?>
                                                    ₽
                                                </p>
                                            </span>
                                        </a>

                                    <?php endfor ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (count($bonds) > 0): ?>
                            <div class="flex flex-col mt-2 gap-4">
                                <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Облигации</h1>
                                <div class="grid grid-cols-2 gap-2">
                                    <?php for ($i = 0; $i < count($bonds); $i++): ?>

                                        <a href="index.php?page=investment&action=sell&type=bonds&id=<?= $bonds[$i][2] ?>"
                                            class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                                            <span class="flex gap-4 items-center">
                                                <img class="object-cover w-14 h-14 rounded-2xl"
                                                    src="<?= get_securities_image($bonds[$i][2]) ?>" alt="">
                                                <span class="flex flex-col">
                                                    <h1 class="font-bold text-slate-950 text-sm capitalize">
                                                        <?= get_securities_name($bonds[$i][2]) ?></h1>
                                                    <p class="text-slate-700 text-sm"><?= $bonds[$i][5] ?> шт.</p>
                                                    <p class="text-slate-700 text-sm">
                                                        <?= number_format($bonds[$i][3], 2, ',', ' ') ?> ₽ →
                                                        <?= number_format($bonds[$i][4], 2, ',', ' ') ?> ₽</p>
                                                </span>
                                            </span>

                                            <span class="flex flex-col text-right">
                                                <p class="text-slate-950 text-sm">
                                                    <?php echo number_format($bonds[$i][3] * $bonds[$i][5], 2, ',', ' '); ?> ₽</p>

                                                <p class="
                          
                          <?php
                          if (abs(get_investment_profit_percent($role["client_id"], $bonds[$i][0])) < 0.0) {
                              echo 'text-red-500';
                          } else if (abs(get_investment_profit_percent($role["client_id"], $bonds[$i][0])) > 0.0) {
                              echo 'text-green-500';
                          } else {
                              echo 'text-slate-500';
                          }
                          ?>
                          
                          text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_percent($role["client_id"], $bonds[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_percent($role["client_id"], $bonds[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_percent($role["client_id"], $bonds[$i][0]), 2, ',', ' ') ?>
                                                    %
                                                </p>

                                                <p class="
                          
                          <?php
                          if (abs(get_investment_profit_value($role["client_id"], $bonds[$i][0])) < 0.0) {
                              echo 'text-red-500';
                          } else if (abs(get_investment_profit_value($role["client_id"], $bonds[$i][0])) > 0.0) {
                              echo 'text-green-500';
                          } else {
                              echo 'text-slate-500';
                          }
                          ?>
                          
                          text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_value($role["client_id"], $bonds[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_value($role["client_id"], $bonds[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_value($role["client_id"], $bonds[$i][0]), 2, ',', ' ') ?>
                                                    ₽
                                                </p>
                                            </span>
                                        </a>

                                    <?php endfor ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (count($currency) > 0): ?>
                            <div class="flex flex-col mt-2 gap-4">
                                <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Валюта</h1>
                                <div class="grid grid-cols-2 gap-2">
                                    <?php for ($i = 0; $i < count($currency); $i++): ?>

                                        <a href="index.php?page=investment&action=sell&type=currency&id=<?= $currency[$i][2] ?>"
                                            class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                                            <span class="flex gap-4 items-center">
                                                <img class="object-cover w-14 h-14 rounded-2xl"
                                                    src="<?= get_securities_image($currency[$i][2]) ?>" alt="">
                                                <span class="flex flex-col">
                                                    <h1 class="text-sm font-bold text-slate-950 capitalize">
                                                        <?= get_securities_name($currency[$i][2]) ?></h1>
                                                    <p class="text-sm text-slate-700"><?= $currency[$i][5] ?> шт.</p>
                                                    <p class="text-sm text-slate-700">
                                                        <?= number_format($currency[$i][3], 2, ',', ' ') ?> ₽ →
                                                        <?= number_format($currency[$i][4], 2, ',', ' ') ?> ₽</p>
                                                </span>
                                            </span>

                                            <span class="flex flex-col text-right">
                                                <p class="text-slate-950 text-sm">
                                                    <?php echo number_format($currency[$i][3] * $currency[$i][5], 2, ',', ' '); ?> ₽
                                                </p>

                                                <p class="
                          
                          <?php
                          if (abs(get_investment_profit_percent($role["client_id"], $currency[$i][0])) < 0.0) {
                              echo 'text-red-500';
                          } else if (abs(get_investment_profit_percent($role["client_id"], $currency[$i][0])) > 0.0) {
                              echo 'text-green-500';
                          } else {
                              echo 'text-slate-500';
                          }
                          ?>
                          
                          text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_percent($role["client_id"], $currency[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_percent($role["client_id"], $currency[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_percent($role["client_id"], $currency[$i][0]), 2, ',', ' ') ?>
                                                    %
                                                </p>

                                                <p class="
                          
                          <?php
                          if (abs(get_investment_profit_value($role["client_id"], $currency[$i][0])) < 0.0) {
                              echo 'text-red-500';
                          } else if (abs(get_investment_profit_value($role["client_id"], $currency[$i][0])) > 0.0) {
                              echo 'text-green-500';
                          } else {
                              echo 'text-slate-500';
                          }
                          ?>
                          
                          text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_value($role["client_id"], $currency[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_value($role["client_id"], $currency[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_value($role["client_id"], $currency[$i][0]), 2, ',', ' ') ?>
                                                    ₽
                                                </p>
                                            </span>
                                        </a>

                                    <?php endfor ?>
                                </div>
                            </div>
                        <?php endif ?>

                        <?php if (count($metals) > 0): ?>
                            <div class="flex flex-col mt-2 gap-4">
                                <h1 class="text-xl font-bold text-slate-950 mb-2 flex gap-1 items-center ">Драгоценный металлы
                                </h1>
                                <div class="grid grid-cols-2 gap-2">
                                    <?php for ($i = 0; $i < count($metals); $i++): ?>

                                        <a href="index.php?page=investment&action=sell&type=metals&id=<?= $metals[$i][2] ?>"
                                            class="flex items-center justify-between p-2 rounded-xl cursor-pointer hover:bg-slate-200/75">
                                            <span class="flex gap-4 items-center">
                                                <img class="object-cover w-14 h-14 rounded-2xl"
                                                    src="<?= get_securities_image($metals[$i][2]) ?>" alt="">
                                                <span class="flex flex-col">
                                                    <h1 class="font-bold text-slate-950 text-sm capitalize">
                                                        <?= get_securities_name($metals[$i][2]) ?></h1>
                                                    <p class="text-slate-700 text-sm"><?= $metals[$i][5] ?> шт.</p>
                                                    <p class="text-slate-700 text-sm">
                                                        <?= number_format($metals[$i][3], 2, ',', ' ') ?> ₽ →
                                                        <?= number_format($metals[$i][4], 2, ',', ' ') ?> ₽</p>
                                                </span>
                                            </span>

                                            <span class="flex flex-col text-right">
                                                <p class="text-slate-950 text-sm">
                                                    <?php echo number_format($metals[$i][3] * $metals[$i][5], 2, ',', ' '); ?> ₽</p>

                                                <p class="
                            
                            <?php
                            if (abs(get_investment_profit_percent($role["client_id"], $metals[$i][0])) < 0.0) {
                                echo 'text-red-500';
                            } else if (abs(get_investment_profit_percent($role["client_id"], $metals[$i][0])) > 0.0) {
                                echo 'text-green-500';
                            } else {
                                echo 'text-slate-500';
                            }
                            ?>
                            
                            text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_percent($role["client_id"], $metals[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_percent($role["client_id"], $metals[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_percent($role["client_id"], $metals[$i][0]), 2, ',', ' ') ?>
                                                    %
                                                </p>

                                                <p class="
                            
                            <?php
                            if (abs(get_investment_profit_value($role["client_id"], $metals[$i][0])) < 0.0) {
                                echo 'text-red-500';
                            } else if (abs(get_investment_profit_value($role["client_id"], $metals[$i][0])) > 0.0) {
                                echo 'text-green-500';
                            } else {
                                echo 'text-slate-500';
                            }
                            ?>
                            
                            text-sm">
                                                    <?php

                                                    if (abs(get_investment_profit_value($role["client_id"], $metals[$i][0])) < 0.0) {
                                                        echo ' ';
                                                    } else if (abs(get_investment_profit_value($role["client_id"], $metals[$i][0])) > 0.0) {
                                                        echo '+';
                                                    } else {
                                                        echo ' ';
                                                    }

                                                    ?>
                                                    <?= number_format(get_investment_profit_value($role["client_id"], $metals[$i][0]), 2, ',', ' ') ?>
                                                    ₽
                                                </p>
                                            </span>
                                        </a>

                                    <?php endfor ?>
                                </div>
                            </div>
                        <?php endif ?>

                    </section>
                </article>

            <?php else: ?>

                <div class="flex justify-center items-center">
                    <article class="bg-slate-50 rounded-3xl w-200 p-16 px-32 flex flex-col gap-4">
                        <span class="flex flex-col justify-center items-center gap-4">
                            <img class="h-20 w-20" src="assets/icon.svg" alt="">
                            <h1 class="font-bold text-2xl text-center text-slate-950">Брокерский счёт <p
                                    class="text-blue-500">Blueberry Bank</p>
                            </h1>
                            <p class="text-slate-700 text-center">Откройте бесплатный счёт и начните зарабатывать на ценных
                                бумагах</p>
                        </span>

                        <?php if (isset($_SESSION['investment_error'])): ?>
                            <div class="w-full bg-red-500/25 p-4
                rounded-xl border-1 border-red-500 text-red-950">
                                <?= $_SESSION['investment_error'] ?>
                                <?php unset($_SESSION['investment_error']) ?>
                            </div>
                        <?php endif ?>

                        <form class="w-full flex flex-col gap-4 mt-2" action="include/investment.php" method="POST">
                            <span class="flex flex-col gap-2">
                                <label
                                    class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2"
                                    for="">
                                    Дата рождения <span class="text-red-500 text-[8px]"><i
                                            class="fa-solid fa-star-of-life"></i></span>
                                </label>
                                <input name="birthday" required
                                    class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200"
                                    type="date">
                            </span>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="consent" required class="h-5 w-5">
                                <label for="consent" class="ml-2 block text-sm text-slate-700">
                                    Я согласен с <a href="#" class="text-blue-500 hover:underline">условиями
                                        обслуживания</a> и
                                    <a href="#" class="text-blue-500 hover:underline">политикой обработки данных</a>
                                </label>
                            </div>

                            <button type="submint" class="w-full cursor-pointer bg-slate-200/50 p-4 rounded-xl text-slate-700 
                    mt-4 hover:bg-blue-100 hover:text-blue-500 mt-8">
                                Открыть брокерский счёт
                            </button>
                        </form>
                    </article>
                </div>

            <?php endif ?>
        </div>
    </div>
</section>