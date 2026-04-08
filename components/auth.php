<?php
    $auth = $_GET['auth'] ?? "login";
?>

<section class="flex justify-center items-center w-full min-h-screen bg-slate-50">
    <div class="flex flex-col w-150 p-8">
        <div class="flex flex-col gap-6 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] p-8">
            <?php if ($auth === "login"): ?>
                <span class="flex flex-col justify-center items-center w-full gap-4">
                    <img class="h-20 w-20" src="assets/icon.svg" alt="">
                    <h1 class="text-slate-950 font-bold text-3xl text-center">
                        С возвращением!
                    </h1>
                </span>

                <?php if (isset($_SESSION["auth_error"])): ?>
                    <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
                        <?php echo $_SESSION["auth_error"] ?>
                        <?php unset($_SESSION["auth_error"]) ?>
                    </div>
                <?php endif ?>

                <form action="include/auth/login.php" method="POST" class="flex flex-col gap-6 w-full">
                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700" for="email">Почта</label>
                        <input required name="email" autocomplete class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" type="email" placeholder="example@domain.com">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700" for="password">Пароль</label>
                        <input name="password" autocomplete required class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" type="password" placeholder="Пароль">
                    </span>

                    <button type="submint" class="cursor-pointer bg-slate-200/50 p-4 rounded-xl text-slate-700
                    hover:bg-blue-100 hover:text-blue-500 mt-auto">
                        Войти 
                    </button>

                    <p class="text-center text-slate-750">
                        Хотите стать клиентом? <br> <a href="index.php?auth=register" class="text-blue-500 hover:underline">Оставьте заявку! </a>
                    </p>
                </form>
            <?php else: ?>

                <span class="flex flex-col justify-center items-center w-full gap-4">
                    <img class="h-20 w-20" src="assets/icon.svg" alt="">
                    <h1 class="text-slate-950 font-bold text-3xl text-center">
                        Станьте клиентом <p class="text-blue-500">Blueberry Bank</p>
                    </h1>
                </span>

                <?php if (isset($_SESSION["register_error"])): ?>
                    <div class="w-full bg-red-500/25 p-4 rounded-xl border-1 border-red-500 text-red-950">
                        <?php echo $_SESSION["register_error"] ?>
                        <?php unset($_SESSION["register_error"]) ?>
                    </div>
                <?php endif ?>

                <form action="include/auth/signup.php" method="POST" class="flex flex-col gap-4 w-full">
                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="surname">
                            Фамилия <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>
                        <input name="surname" required class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" type="text" placeholder="Храмцов">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Имя <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>
                        <input name="name" required class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" type="text" placeholder="Лев">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700" for="">Отчество </label>
                        <input name="middle" class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" type="text" placeholder="Сергеевич">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Серия паспорта <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>

                        <input 
                            required
                            class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200
                            [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            placeholder="1234"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            type="number"
                            maxlength="4"
                            name="passport-serial"
                        />
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Номер паспорта <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>

                        <input 
                            required
                            class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200
                            [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                            placeholder="567890"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            type="number"
                            maxlength="6"
                            name="passport-number"
                        />
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Email <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>
                        <input 
                        class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200"
                        name="email" required type="email" placeholder="example@domain.com">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Пароль <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>
                        <input 
                        class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" 
                        name="password" required type="password">
                    </span>

                    <span class="flex flex-col gap-2">
                        <label class="font-bold text-slate-950 text-lg placeholder:text-slate-700 flex items-center gap-2" for="">
                            Подтвердите пароль <span class="text-red-500 text-[8px]"><i class="fa-solid fa-star-of-life"></i></span>
                        </label>
                        <input name="password-confirmation" required class="p-3 px-4 rounded-xl outline-none text-slate-950 bg-slate-200/50 focus:bg-slate-200" 
                        type="password">
                    </span>

                    <div class="flex items-center">
                        <input type="checkbox" id="consent" required class="h-5 w-5">
                        <label for="consent" class="ml-2 block text-sm text-slate-700">
                        Я согласен с <a href="#" class="text-blue-500 hover:underline">условиями обслуживания</a> и 
                        <a href="#" class="text-blue-500 hover:underline">политикой обработки данных</a>
                        </label>
                    </div>

                    <span class="mt-8">
                        <button type="submit" class="w-full cursor-pointer bg-slate-200/50 p-4 rounded-xl text-slate-700 
                        mt-4 hover:bg-blue-100 hover:text-blue-500 mt-auto">
                            Открыть счёт
                        </button>
                    </span>

                    <p class="text-center text-slate-750">
                        Уже являетесь клиентом? <br> <a href="index.php" class="text-blue-500 hover:underline">Войти в аккаунт</a>
                    </p>
                </form>
            <?php endif ?>

            <span class="flex flex-col gap-2 mt-4">
                <p class="text-center text-slate-500">&copy; <?= date("Y") ?>  АО «ББ»</p>
                <p class="text-center text-slate-500">Генеральная лицензия №0 Банка России</p>
            </span>
        </div>
    </div>
</section>