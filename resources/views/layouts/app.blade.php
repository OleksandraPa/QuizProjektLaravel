<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Quizzes</title>
    
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f8f9fa;
            color: #333;
        }
        
        header { 
            background-color: #2c3e50; 
            color: white; 
            padding: 15px 0; 
            text-align: center;
        }
        
        header nav a { 
            color: white; 
            text-decoration: none; 
            margin: 0 15px; 
            font-weight: bold;
        }
        
        main { 
            padding: 40px 20px; 
            display: flex;
            justify-content: center;
        }

        .content-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }
        
        .alert { 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 8px; 
            font-weight: bold; 
            text-align: center;
        }
        .alert-success { 
            background-color: #d4edda; 
            color: #2ecc71; 
            border: 1px solid #c3e6cb; 
        }
        .alert-danger { 
            background-color: #f8d7da; 
            color: #e74c3c; 
            border: 1px solid #f5c6cb; 
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Strona Główna</a>
            <a href="{{ route('quizzes.index') }}">Lista Quizów</a>
        </nav>
    </header>

    <main>
        <div class="content-container">
            @yield('content') 
        </div>
    </main>
</body>
</html>