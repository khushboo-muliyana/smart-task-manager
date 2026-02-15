<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LaraFlow AI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 min-h-screen text-gray-800">

<!-- NAVBAR -->
<nav class="flex justify-between items-center px-8 py-5 max-w-7xl mx-auto">

    <h1 class="text-2xl font-bold text-indigo-700">
        LaraFlow AI
    </h1>

    <div class="space-x-4">

        @auth
            <a href="{{ route('dashboard') }}"
               class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition shadow">
                Dashboard →
            </a>
        @else
            <a href="{{ route('login') }}"
               class="text-gray-700 hover:text-indigo-600 font-medium">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition shadow">
                Register
            </a>
        @endauth

    </div>

</nav>


<!-- HERO -->
<section class="text-center mt-16 px-6 max-w-4xl mx-auto">

    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
        Smart Project & Task Management
        <span class="block mt-3 text-indigo-600">
            Powered by AI
        </span>
    </h2>
    <p class="mt-6 text-lg text-gray-600">
        LaraFlow AI helps you organize projects, track tasks, and stay productive —
        all in one beautiful workspace.
    </p>

    <div class="mt-8 flex justify-center gap-4 flex-wrap">

        @auth
            <a href="{{ route('dashboard') }}"
               class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow">
                Continue to Dashboard →
            </a>
        @else
            <a href="{{ route('register') }}"
               class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition shadow">
                Get Started Free
            </a>

            <a href="{{ route('login') }}"
               class="bg-white border border-gray-300 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition shadow">
                Login
            </a>
        @endauth

    </div>

</section>


<!-- FEATURES -->
<section class="mt-24 px-6">

    <h3 class="text-3xl font-bold text-center mb-12">
        Why Choose LaraFlow AI?
    </h3>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-3">Smart Task Tracking</h4>
            <p class="text-gray-600">
                Manage tasks effortlessly with progress tracking and analytics.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-3">Project Organization</h4>
            <p class="text-gray-600">
                Keep all projects structured and accessible in one place.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow hover:shadow-lg transition">
            <h4 class="text-xl font-semibold mb-3">AI Productivity Insights</h4>
            <p class="text-gray-600">
                Gain insights that help you work smarter, not harder.
            </p>
        </div>

    </div>

</section>


<!-- CTA -->
<section class="text-center mt-24 mb-16 px-6">

    @auth

        <h3 class="text-3xl font-bold mb-4">
            Ready to continue your workflow?
        </h3>

        <p class="text-gray-600 mb-8">
            Jump back into your projects and stay productive.
        </p>

        <a href="{{ route('dashboard') }}"
           class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-lg">
            Go to Dashboard →
        </a>

    @else

        <h3 class="text-3xl font-bold mb-4">
            Ready to boost your productivity?
        </h3>

        <p class="text-gray-600 mb-8">
            Join LaraFlow AI and start managing smarter today.
        </p>

        <a href="{{ route('register') }}"
           class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-semibold hover:bg-indigo-700 transition shadow-lg">
            Create Free Account
        </a>

    @endauth

</section>


<!-- FOOTER -->
<footer class="text-center text-gray-500 pb-6">
    © {{ date('Y') }} LaraFlow AI — Built with Laravel
</footer>

</body>
</html>