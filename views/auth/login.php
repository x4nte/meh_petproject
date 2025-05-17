<?php /** @var \App\Core\View\View $view */
$view->component('header');?>
    <form class="max-w-sm mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg space-y-6" action="/login" method="POST">
        <h2 class="text-2xl font-bold text-center text-gray-800">Log In</h2>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                    type="email"
                    id="email"
                    name="email"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com"
                    required
            />
            <?php $view->error('email');?>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
            />
            <?php $view->error('password');?>
        </div>

        <button
                type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition"
        >
        Log In
        </button>


    </form>

<?php $view->component('footer'); ?>