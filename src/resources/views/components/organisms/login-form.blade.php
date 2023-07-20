<main class="w-full max-w-md mx-2">
    <div class="p-2">
        <x-molecules.breadcrumb :paths="$paths" />
    </div>
    <div class="my-3">
        <x-molecules.alert-status :status="$errors->any() ? ['type' => 'error', 'message' => implode(PHP_EOL, $errors->all())] : []" />
        <x-molecules.alert-status :status="session(config('define.session.status'), [])" />
    </div>
    <form action="{{ $loginLink }}" method="POST">
        @csrf
        <div class="bg-white border border-gray-300 rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    メールアドレス
                </label>
                <input class="border border-gray-200 appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" name="email" type="text" value="test1@test.com" placeholder="test@test.com">
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    パスワード
                </label>
                <input class="border border-gray-200 appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" name="password" type="password" value="qwertyuiop">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded w-full">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i> ログイン
                </button>
            </div>
        </div>
    </form>
</main>
