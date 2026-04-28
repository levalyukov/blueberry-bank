<!-- 

        

-->


<span class="flex items-center gap-4">
    <el-dropdown class="inline-block">
        <button class="bg-slate-300/75 h-10 w-10 flex justify-center gap-x-1.5 rounded-xl text-md font-semibold text-slate-700 cursor-pointer hover:text-slate-950 hover:bg-slate-300">
        <span class="text-xl h-10 w-10 flex justify-center items-center"><i class="fa-solid fa-bell"></i></span>
        </button>
        <el-menu anchor="bottom end" class="w-55 origin-top-right rounded-xl bg-slate-50 mt-2 border-1 border-slate-300 shadow-md">
        <?php include_once("notifications.php") ?>
        </el-menu>
    </el-dropdown>
    
    <el-dropdown class="inline-block">
        <button class="inline-flex w-full justify-center gap-x-1.5 rounded-md text-md font-semibold text-white hover:opacity-75">
            <img class="rounded-full object-cover h-13 w-13 shrink-0 cursor-pointer" src="https://i.pinimg.com/736x/5b/92/e0/5b92e0bc6b379e2278373e63f174a10f.jpg" alt="user-profive.jpg">
        </button>
        <el-menu anchor="bottom end" class="w-55 origin-top-right rounded-xl bg-slate-50 mt-2 border-1 border-slate-300 shadow-md">
            <form class="py-1" action="include/client-dropdown.php" method="POST">
                <button href="#" class="w-full cursor-pointer flex gap-2 px-4 py-3 text-md text-slate-700 focus:bg-slate-200/75 focus:text-slate-950 focus:outline-hidden">
                    <span class="w-5 h-5 text-md"><i class="fa-solid fa-user"></i></span> Аккаунт
                </button>
                
                <button href="#" class="w-full cursor-pointer flex gap-2 px-4 py-3 text-md text-slate-700 focus:bg-slate-200/75 focus:text-slate-950 focus:outline-hidden">
                    <span class="w-5 h-5 text-md"><i class="fa-solid fa-headset"></i></span> Техподдержка
                </button>
                
                <button href="#" class="w-full cursor-pointer flex gap-2 px-4 py-3 text-md text-slate-700 focus:bg-slate-200/75 focus:text-slate-950 focus:outline-hidden">
                    <span class="w-5 h-5 text-md"><i class="fa-solid fa-gear"></i></span> Настройки
                </button>
                
                <button type="submit" name="client-signout" class="cursor-pointer flex gap-2 w-full px-4 py-3 text-left text-md text-slate-700 focus:bg-slate-200/75 focus:text-slate-950 focus:outline-hidden">
                    <span class="w-5 h-5 text-md"><i class="fa-solid fa-door-open"></i></span> Выйти
                </button>
            </form>
        </el-menu>
    </el-dropdown>
</span>