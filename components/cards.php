<!-- 

    

-->


<section class="px-12 pt-8 w-full h-screen overflow-y-scroll overflow-y-auto [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
  <header class="flex w-full justify-between items-center gap-2 mb-6">
    <span class="flex flex-col gap-2">
      <h1 class="text-3xl font-bold text-slate-950 capitalize">Мои карты</h1>
    </span>

    <?php include_once("user-panel.php") ?>
  </header>

  <div class="flex flex-col">
    <div class="flex gap-6">
      <article id="total-balance" class="bg-slate-950 h-65 rounded-3xl p-8 w-full">
        <div class="flex flex-col h-full">
          <span class="flex flex-col gap-2">
            <span class="flex justify-between">
              <h1 class="text-slate-400 uppercase">Общий баланс</h1>
              <button class="text-slate-400 bg-slate-950 w-12 px-2 py-1 rounded-md cursor-pointer">
                <span><i class="fa-solid fa-eye"></i></span>
              </button>
            </span>

            <h1 class="text-slate-50 uppercase font-bold text-3xl">52 630 401,58 ₽</h1>
          </span>

          <span class="flex flex-col mt-auto gap-4">
            <p class="bg-slate-950 px-4 py-2 text-green-500 rounded-full w-28 text-center">+10,52 %</p>
            <span class="flex justify-between items-center">
              <p class="text-slate-400">**** **** **** 4567</p>
              <p class="text-slate-400">01/38</p>
            </span>
          </span>
        </div>
      </article>

      <article id="total-balance" class="bg-red-500 h-65 rounded-3xl p-8 w-full">
        <div class="flex flex-col h-full">
          <span class="flex flex-col gap-2">
            <span class="flex justify-between">
              <h1 class="text-slate-200 uppercase">Общий баланс</h1>
              <button class="text-slate-400 bg-slate-950 w-12 px-2 py-1 rounded-md cursor-pointer">
                <span><i class="fa-solid fa-eye"></i></span>
              </button>
            </span>

            <h1 class="text-slate-50 uppercase font-bold text-3xl">52 630 401,58 ₽</h1>
          </span>

          <span class="flex flex-col mt-auto gap-4">
            <p class="bg-slate-950 px-4 py-2 text-green-500 rounded-full w-28 text-center">+10,52 %</p>
            <span class="flex justify-between items-center">
              <p class="text-slate-400">**** **** **** 4567</p>
              <p class="text-slate-400">01/38</p>
            </span>
          </span>
        </div>
      </article>

      <article id="total-balance" class="bg-green-400 h-65 rounded-3xl p-8 w-full">
        <div class="flex flex-col h-full">
          <span class="flex flex-col gap-2">
            <span class="flex justify-between">
              <h1 class="text-slate-50 uppercase">Общий баланс</h1>
              <button class="text-slate-400 bg-slate-950 w-12 px-2 py-1 rounded-md cursor-pointer">
                <span><i class="fa-solid fa-eye"></i></span>
              </button>
            </span>

            <h1 class="text-slate-50 uppercase font-bold text-3xl">52 630 401,58 ₽</h1>
          </span>

          <span class="flex flex-col mt-auto gap-4">
            <p class="bg-slate-950 px-4 py-2 text-green-500 rounded-full w-28 text-center">+10,52 %</p>
            <span class="flex justify-between items-center">
              <p class="text-slate-400">**** **** **** 4567</p>
              <p class="text-slate-400">01/38</p>
            </span>
          </span>
        </div>
      </article>
    </div>
  </div>
  
</section>