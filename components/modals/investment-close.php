<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center items-center">
    <div class="w-150 bg-slate-50 m-5 rounded-xl shadow-md">
        <header class="p-2 flex justify-end">
            <a href="index.php?page=investment" class="flex h-8 w-8 justify-center items-center text-slate-700 
            hover:text-slate-50 hover:bg-red-400 rounded-lg">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </header>

        <div class="flex flex-col px-8 pb-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <h1 class="font-bold text-3xl text-slate-950">Закрытие счёта</h1>
        
            <div>
                <p class="text-slate-700">
                    После закрытия счета вы потеряете доступ к текущим инвестиционным инструментам и аналитике. <br><br>
                    Перед закрытием убедитесь, что:
                    <ul class="text-slate-700 list-disc pl-5 py-4">
                        <li>Вы продали все ценные бумаги.</li>
                        <li>Вы вывели оставшиеся рубли и валюту.</li>
                        <li>У вас нет активных и незавершенных сделок.</li>
                        <li>Если всё готово, нажмите «Подтвердить». </li>
                    </ul>
                </p>

                <p class="text-slate-700">Торговля станет недоступна сразу.</p>
            </div>

            <?php if (isset($_SESSION["investment-account-refill"])): ?>
                <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
                    <?= $_SESSION["investment-account-refill"] ?>
                    <?php unset($_SESSION["investment-account-refill"]) ?>
                </div>
            <?php endif ?>
        
            <div class="flex flex-col">
                <form action="" class="flex flex-col gap-6 h-full">
                    <a href="include/investment/investment-close.php?user_id=<?= $role["client_id"] ?>"
                    class="w-full text-slate-950 bg-slate-300/50 cursor-pointer text-center gap-2 p-4 
                    hover:bg-blue-100 hover:text-blue-500 rounded-xl mt-auto">
                        Закрыть счёт
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>