<main class="w-full max-w-md mx-2">
    <div class="">
        <x-organisms.breadcrumb-section :paths="$paths" />
    </div>
    <form action="{{ $loginLink }}" method="POST">
        @csrf
        <div class="bg-white border border-gray-300 rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    メールアドレス
                </label>
                <input class="border border-gray-200 appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" name="email" type="email" value="" placeholder="test@test.com">
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    パスワード
                </label>
                <input class="border border-gray-200 appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" name="password" type="password">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-full">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> ログイン
                </button>
            </div>
        </div>
    </form>
</main>
