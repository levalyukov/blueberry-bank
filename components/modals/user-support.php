<?php
    require_once("include/dashboard.php");
    require_once("include/transactions.php");
?>

<div class="absolute bg-slate-950/25 w-full h-screen backdrop-blur-xs z-1 flex justify-center items-center">
    <div class="w-200 bg-slate-50 m-5 rounded-xl shadow-md">
        <header class="p-2 flex justify-end">
            <a href="index.php?page=dashboard" class="flex h-8 w-8 justify-center items-center text-slate-700 
      hover:text-slate-50 hover:bg-red-400 rounded-lg">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </header>

        <div
            class="flex flex-col px-8 pb-8 gap-6 overflow-y-scroll h-[calc(100%-64px)] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <h1 class="font-bold text-3xl text-slate-950">Чат с поддержкой</h1>

            <?php if (isset($_SESSION["account-refill-error"])): ?>
                <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
                    <?= $_SESSION["account-refill-error"] ?>
                    <?php unset($_SESSION["account-refill-error"]) ?>
                </div>
            <?php endif ?>

            <div class="flex h-125 flex-col">
                <div class="bg-slate-200 rounded-3xl flex flex-col h-full w-full p-4">
                    <article class="flex items-top gap-4 bg-slate-50 p-4 rounded-3xl rounded-bl-none">
                        <img class="h-16 w-16 rounded-full object-cover" src="https://i.pinimg.com/736x/0b/6c/44/0b6c44a2bb3e369362c57911c66fbcc9.jpg" alt="">
                        <span>
                            <h1 class="font-bold text-slate-950">Техподдержка</h1>
                            <p class="text-slate-700">Добрый день! Банк Blueberry, меня зовут Григорий. Чем я могу вам помочь?</p>
                        </span>
                    </article>

                    <article class="mt-auto">
                        <!-- <img class="h-50 object-cover rounded-3xl w-full" src="" alt=""> -->
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>