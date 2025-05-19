<nav class="bg-white border-b shadow-sm">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex space-x-6">
            <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-150">Home</a>
            <a href="/posts"
               class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-150">Posts</a>
        </div>
        <div>
            <?php /** @var \App\Core\View\View $view */
            if($view->session->has('user_id')): ?>
                <form action="/logout" method="POST">
                    <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 text-white font-semibold py-1.5 px-4 rounded-md transition-all duration-150">LogOut</button>
                </form>
            <?php else: ?>
                <a href="/register"
                   class="inline-block bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 text-white font-semibold py-1.5 px-4 rounded-md transition-all duration-150">
                    Register
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>
