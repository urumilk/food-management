<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>TOP - 食材管理アプリ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-yusei antialiased bg-amber-50 dark:bg-amber-50 overflow-hidden">
        <div class="min-h-screen bg-amber-50 dark:bg-amber-50">
            <h1 class="text-center text-4xl md:text-7xl font-bold font-yusei text-stone-700 mb-8 mt-20">残さず食べよう</h1>
            <h2 class="text-center text-4xl md:text-5xl font-bold font-yusei text-stone-700 mb-4">食材管理アプリ</h2>
            <div class="flex items-center justify-center">
                <div class="max-w-3xl text-center">
                    <img src="{{ asset('images/bread-girl.png') }}" alt="冷蔵庫のイラスト" class="w-full max-w-md mx-auto" />
                </div>
                <div class="max-w-5xl flex items-center justify-center">
                    <a
                        href="{{ route('login') }}"
                        class="inline-block p-6 mr-6 text-orange-500 border border-sky-200 border-4 bg-sky-100 hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-lg font-yusei text-4xl md:text-4xl leading-normal"
                    >
                        ログイン
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-block p-6 mr-6 text-orange-500 border border-fuchsia-200 border-4 bg-fuchsia-100 hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-lg font-yusei text-4xl md:text-4xl leading-normal"
                    >
                        新規登録
                    </a>
                </div>
            </div>
        </div>
            
    </body>
</html>

    
