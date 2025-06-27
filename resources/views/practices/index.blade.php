<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Practice Records</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 2rem auto;
            max-width: 760px;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
            color: #000000;
        }

        h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 0.05em;
            font-style: italic;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            color: #000000;
        }

        .button-group {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .button-group a {
            padding: 0.6rem 1.2rem;
            background-color: #f8d7da;
            /* 薄いピンク */
            color: #000000;
            /* 文字色を黒に */
            font-weight: 700;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 5px 18px rgba(248, 215, 218, 0.6);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .button-group a:hover {
            background-color: #f5c6cb;
            /* ほんの少し濃いピンク */
            box-shadow: 0 8px 28px rgba(245, 198, 203, 0.8);
        }

        .button-group a:hover {
            background-color: #f5c6cb;
            /* ほんの少し濃いピンク */
            box-shadow: 0 8px 28px rgba(245, 198, 203, 0.8);
        }

        .button-group a:hover {
            background-color: #f5c6cb;
            /* ほんの少し濃いピンク */
            box-shadow: 0 8px 28px rgba(245, 198, 203, 0.8);
        }

        .button-group a:hover {
            background-color: #0288d1;
            box-shadow: 0 8px 28px rgba(2, 136, 209, 0.6);
        }

        .practices {
            margin-top: 1rem;
        }

        .practice {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 12px 25px rgba(2, 119, 189, 0.1);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .practice-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #000000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            letter-spacing: 0.03em;
        }

        .practice-title a {
            font-size: 0.9rem;
            color: #0288d1;
            text-decoration: none;
            font-weight: 600;
            margin-left: 1rem;
            padding: 0.2rem 0.6rem;
            border: 1.5px solid #0288d1;
            border-radius: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .practice-title a:hover {
            background-color: #0288d1;
            color: white;
        }

        .practice-body {
            margin-top: 0.6rem;
            color: #000000;
            font-weight: 500;
        }

        .practice-body p {
            margin: 0.25rem 0;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
        }

        .footer a {
            padding: 0.5rem 1rem;
            background-color: #6c757d;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 5px 18px rgba(108, 117, 125, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .footer a:hover {
            background-color: #495057;
            box-shadow: 0 8px 28px rgba(73, 80, 87, 0.6);
        }
    </style>
</head>

<body>
    <h1>Practice Records</h1>

    <div class="button-group">
        <a href="/practices/create">Create</a>
    </div>

    <div class='practices'>
        @forelse ($practices as $practice)
        <div class='practice'>
            <div class='practice-title'>
                <span>{{ $practice->date }} - {{ $practice->instrument }}</span>
                <a href="{{ route('practices.show', $practice->id) }}">Detail</a>
            </div>
            <div class='practice-body'>
                @php
                $duration = $practice->duration ?? '00:00:00';
                [$h, $m, $s] = explode(':', $duration);
                @endphp
                <p>Time: {{ (int)$h }}h {{ (int)$m }}min</p>

                <p>Content: {{ $practice->content }}</p>
            </div>
        </div>
        @empty
        <p>Your practice log is empty.</p>
        @endforelse
    </div>
    <div class="footer">
        <a href="/">Back</a>
    </div>
</body>

</html>