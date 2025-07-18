<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Practice Records</title>
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
        }

        .button-group {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .button-group a {
            padding: 0.6rem 1.2rem;
            background-color: #f8d7da;
            color: #000000;
            font-weight: 700;
            border-radius: 30px;
            text-decoration: none;
            box-shadow: 0 5px 18px rgba(248, 215, 218, 0.6);
        }

        .button-group a:hover {
            background-color: #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
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
            display: flex;
            align-items: center;
            justify-content: space-between;
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
        }

        .practice-title a:hover {
            background-color: #0288d1;
            color: white;
        }

        .practice-body {
            margin-top: 0.6rem;
            font-weight: 500;
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
        }

        .footer a:hover {
            background-color: #495057;
        }

        /* ページネーション */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
            font-weight: 600;
        }

        /* 数字リンクの基本スタイル */
        .pagination li {
            list-style: none;
        }

        .pagination a,
        .pagination span {
            color: #0288d1;
            text-decoration: none;
            padding: 6px 10px;
            font-size: 15px;
            /* no border, no background */
            border-radius: 0;
            box-shadow: none;
            cursor: pointer;
        }

        /* 現在ページは太字黒色 */
        .pagination .active span {
            color: #000000;
            font-weight: 900;
            cursor: default;
        }

        /* 無効リンクは薄いグレー */
        .pagination .disabled span {
            color: #ccc;
            cursor: not-allowed;
        }

        /* 矢印アイコンは非表示 */
        .pagination svg {
            display: none !important;
        }
    </style>
</head>

<body>
    <h1>Practice Records</h1>

    <div class="button-group">
        <a href="/practices/create">Create</a>
    </div>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class='practices'>
        @forelse ($practices as $practice)
        <div class='practice'>
            <div class='practice-title'>
                <span>{{ $practice->date }} - {{ $practice->instrument }}</span>
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ route('practices.show', $practice->id) }}">Detail</a>

                    <form action="{{ route('practices.delete', $practice->id) }}" method="POST" onsubmit="return confirm('This action cannot be undone. Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="
                            background-color: #dc3545;
                            color: #ffffff;
                            font-weight: 600;
                            border: none;
                            border-radius: 20px;
                            padding: 0.2rem 0.6rem;
                            cursor: pointer;
                            font-size: 0.9rem;
                            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
                        ">Delete</button>
                    </form>
                </div>
            </div>

            <div class='practice-body'>
                @php
                $duration = $practice->duration ?? '00:00:00';
                [$h, $m, $s] = explode(':', $duration);
                @endphp
                <p>Duration: {{ (int)$h }}h {{ (int)$m }}min</p>
                <p>Content: {{ $practice->content }}</p>
            </div>
        </div>
        @empty
        <p>Your practice log is empty.</p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $practices->links() }}
    </div>

    <div class="footer">
        <a href="/">Back</a>
    </div>
</body>

</html>