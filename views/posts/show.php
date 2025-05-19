<?php /** @var \App\Core\View\View $view */
$view->component('header');
$view->component('nav'); ?>

<main class="flex-grow container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Posts</h1>
        <a href="/posts/create"
           class="bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
            Create Post
        </a>
    </div>

    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <?php /** @var array $posts */
        foreach ($posts as $post) : ?>
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-200 p-5 flex flex-col">
                <h2 class="text-xl font-semibold mb-2 text-gray-800 hover:text-blue-600 transition-colors duration-150">
                    <?= htmlspecialchars($post['title'], ENT_QUOTES) ?>
                </h2>
                <p class="text-gray-600 flex-grow">
                    <?= nl2br(htmlspecialchars($post['body'], ENT_QUOTES)) ?>
                </p>
                <a href="/posts/<?= $post['id'] ?>"
                   class="mt-4 inline-block self-start text-blue-500 hover:text-blue-600 font-medium transition-colors duration-150">
                    Читать далее →
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php $view->component('footer'); ?>
</body>
</html>
