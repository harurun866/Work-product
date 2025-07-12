<x-app-layout>
    <x-slot name="header"></x-slot>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        html,
        body,
        .min-h-screen {
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe) !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .app-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .app-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .catch-copy {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.3rem;
        }

        .sub-copy {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        #calendar-container {
            background: #f9fafb;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 1rem;
        }
    </style>

    <div class="min-h-screen py-4">
        <div class="max-w-3xl mx-auto px-4">
            <div class="app-card text-center">

                <div class="app-title">Oto Nest♪</div>
                <div class="catch-copy">音楽の練習を、もっと楽しく、もっとつながる。</div>
                <p class="sub-copy">Support your music habits with Oto Nest. Record your practice and stay motivated with your peers.</p>

                <div id="calendar-container">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
    <!-- <script src="https://unpkg.com/alpinejs" defer></script>
    <x-slot name="scripts">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    initialView: 'dayGridMonth',
                    height: 500,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    }
                });
                calendar.render();
            });
        </script> -->
    </x-slot>
</x-app-layout>