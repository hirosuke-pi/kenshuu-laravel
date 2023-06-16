<div>
    <form action="/actions/logout.php" method="POST">
        <button class="hover:bg-gray-200 rounded-lg p-2 mr-4 mt-3 ">
            <i class="fa-solid fa-right-from-bracket"></i> ログアウト
        </button>
        <?php PageController::setCsrfToken(CSRF_LOGOUT) ?>
    </form>
    <a href="<?=$userUrl ?>" class="flex items-center py-2 px-4 hover:bg-gray-200 rounded-lg border border-gray-300 mt-3">
        <img class="w-7 h-7 rounded-full object-cover mr-1" src="<?=$profileImageSrc ?>" alt="user image">
        <p class="text-xl font-bold">@<?=convertSpecialCharsToHtmlEntities($user->username) ?></p>
    </a>
</div>
