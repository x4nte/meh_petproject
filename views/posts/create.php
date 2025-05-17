<?php /** @var \App\Core\View\View $view */
$view->component('header'); ?>
<form class="max-w-md mx-auto p-6 bg-white rounded-2xl shadow-md space-y-6" action="/posts" method="POST">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input
                type="text"
                id="title"
                name="title"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter title"
        />
        <?php $view->error('title');?>
    </div>

    <div>
        <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
        <textarea
                id="body"
                name="body"
                rows="4"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter body content"
        ></textarea>
        <?php $view->error('body');?>
    </div>

    <button
            type="submit"
            class="w-full py-2 px-4 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition"
    >
        Submit
    </button>
</form>

<?php $view->component('footer'); ?>;