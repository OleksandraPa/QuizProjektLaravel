<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuizPlanet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased" style="background-color: #f3f4f6; font-family: sans-serif; margin: 0;"> 

    <nav style="background-color: white; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-bottom: 1px solid #e5e7eb;">
        <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
            
            <div style="font-size: 24px; font-weight: 800; color: #2563EB; letter-spacing: -0.5px;">
                QuizPlanet 🌍
            </div>

            <div>
                @if (Route::has('login'))
                    @auth
                        {{-- Jeśli zalogowany --}}
                        <a href="{{ url('/dashboard') }}" 
                           style="color: #4B5563; text-decoration: none; font-weight: bold; margin-right: 20px; transition: color 0.2s;">
                           Panel Gracza
                        </a>
                    @else
                        {{-- Jeśli NIE zalogowany --}}
                        <a href="{{ route('login') }}" 
                           style="color: #4B5563; text-decoration: none; font-weight: bold; margin-right: 20px;">
                           Logowanie
                        </a>
                        <a href="{{ route('register') }}" 
                           style="color: #2563EB; text-decoration: none; font-weight: bold;">
                           Rejestracja
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div style="max-width: 1000px; margin: 80px auto; padding: 0 20px;">
        
        <div style="background-color: white; padding: 60px 40px; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); text-align: center;">

            <h1 style="font-size: 48px; font-weight: 900; color: #111827; margin-bottom: 10px; line-height: 1.2;">
                Witamy w QuizPlanet!
            </h1>
            
            <h2 style="font-size: 24px; font-weight: normal; color: #6B7280; margin-top: 0; margin-bottom: 40px;">
                Sprawdź swoją wiedzę i baw się nauką
            </h2>

            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                @auth
                    <a href="{{ url('/quizzes') }}" 
                       style="background-color: #2563EB; color: white; padding: 16px 40px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 18px; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3); transition: background-color 0.3s;">
                        🚀 Rozpocznij naukę
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       style="background-color: white; color: #2563EB; border: 2px solid #2563EB; padding: 14px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 18px;">
                        Zaloguj się
                    </a>

                    <a href="{{ route('register') }}" 
                       style="background-color: #2563EB; color: white; padding: 16px 40px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 18px; box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);">
                        Dołącz teraz
                    </a>
                @endauth
            </div>

        </div>

        <div style="text-align: center; margin-top: 40px; color: #9CA3AF; font-size: 14px;">
            &copy; {{ date('Y') }} QuizPlanet. Nauka przez zabawę.
        </div>

    </div>
</body>
</html>