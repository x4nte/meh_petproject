<?php
/** @var \App\Core\View\View $view */
/** @var array $post */
$view->component('header');
$view->component('nav');
?>

<main class="flex-grow container mx-auto px-4 py-10">
    <div class="max-w-3xl mx-auto space-y-6">

        <a href="/posts"
           class="inline-block text-gray-600 hover:text-gray-800 transition-colors duration-150 mb-4">
            ← Все посты
        </a>

        <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-200 overflow-hidden">
            <header class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
                <h1 class="text-4xl font-extrabold text-white">
                    <?= htmlspecialchars($post['title'], ENT_QUOTES) ?>
                </h1>
            </header>
            <div class="p-6 prose prose-lg text-gray-700 break-words">
                <?= nl2br(htmlspecialchars($post['body'], ENT_QUOTES)) ?>
            </div>
        </article>

        <div class="flex space-x-4">
            <a href="/posts/<?= $post['id'] ?>/edit"
               class="flex-1 text-center bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-150">
                Редактировать
            </a>
            <form action="/posts/<?= $post['id'] ?>" method="POST" onsubmit="return confirm('Удалить пост?');" class="flex-1">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit"
                        class="w-full bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-150">
                    Удалить
                </button>
            </form>
        </div>

    </div>
</main>

<?php $view->component('footer'); ?>
