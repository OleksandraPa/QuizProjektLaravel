<nav class="bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Lewa strona: Dashboard i Quizy -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 font-semibold rounded-lg text-white 
                   {{ request()->routeIs('dashboard') ? 'bg-blue-600' : 'bg-gray-700 hover:bg-gray-600' }} transition-colors">
                    Dashboard
                </a>
                <a href="{{ route('quizzes.index') }}" 
                   class="px-4 py-2 font-semibold rounded-lg text-white 
                   {{ request()->routeIs('quizzes.*') ? 'bg-blue-600' : 'bg-green-600 hover:bg-green-700' }} transition-colors">
                    Quizy
                </a>
            </div>

            <!-- Prawa strona: Wyloguj -->
            <div class="flex items-center">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 font-semibold rounded-lg text-white bg-red-600 hover:bg-red-700 transition-colors">
                            Wyloguj
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>
