<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <title>Practice Log</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
            margin: 2rem auto;
            max-width: 760px;
            padding: 2rem;
            color: #000000;
        }

        h1 {
            font-weight: 900;
            font-size: 2.4rem;
            margin-bottom: 0.5rem;
            text-align: center;
            color: #000000;
            letter-spacing: 0.05em;
            font-style: italic;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .detail-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 12px 25px rgba(2, 119, 189, 0.1);
            padding: 2rem 2.5rem;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            border-bottom: 1px dashed #b3e5fc;
            font-size: 1.1rem;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item strong {
            color: #000000;
            font-style: normal;
            width: 130px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .detail-item span {
            max-width: 75%;
            text-align: right;
            font-weight: 600;
            color: #000000;
        }

        .text-section {
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            color: #000000;
        }

        .left {
            background-color: #e3f2fd;
            border-left: 6px solid #0288d1;
        }

        .right {
            background-color: #f1f8e9;
            border-right: 6px solid #81c784;
        }

        .text-section h3 {
            margin-top: 0;
            margin-bottom: 0.8rem;
            color: #000000;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .text-section p {
            white-space: pre-wrap;
            color: #000000;
            line-height: 1.6;
            font-weight: 500;
        }

        .buttons {
            margin-top: 2.5rem;
            text-align: center;
        }

        .buttons a {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            margin: 0 0.6rem;
            border-radius: 30px;
            font-size: 1rem;
            text-decoration: none;
            font-weight: 700;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #f8d7da;
            color: #000000;
            box-shadow: 0 5px 18px rgba(248, 215, 218, 0.6);
        }

        .btn-edit:hover {
            background-color: #f5c6cb;
            box-shadow: 0 8px 28px rgba(245, 198, 203, 0.8);
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
            box-shadow: 0 5px 18px rgba(108, 117, 125, 0.4);
        }

        .btn-back:hover {
            background-color: #495057;
            box-shadow: 0 8px 28px rgba(73, 80, 87, 0.6);
        }
    </style>
</head>

<body>
    <h1>Practice Log</h1>

    <div class="detail-card">
        <div class="detail-item"><strong>Date:</strong> <span>{{ $practice->date }}</span></div>
        <div class="detail-item"><strong>Instrument:</strong> <span>{{ $practice->instrument }}</span></div>
        @php
        $duration = $practice->duration ?? '00:00:00';
        list($h, $m, $s) = explode(':', $duration);
        @endphp

        <div class="detail-item">
            <strong>Duration:</strong> <span>{{ (int)$h }}h {{ (int)$m }}min</span>
        </div>


        <div class="detail-item"><strong>Genre:</strong> <span>{{ $practice->genre }}</span></div>

        <div class="text-section left">
            <h3>Content</h3>
            <p>{{ $practice->content }}</p>
        </div>

        <div class="text-section right">
            <h3>Reflection</h3>
            <p>{{ $practice->reflection }}</p>
        </div>

        <div class="text-section left">
            <h3>Next Goal</h3>
            <p>{{ $practice->next_goal }}</p>
        </div>

        <div class="text-section right">
            <h3>Memo</h3>
            <p>{{ $practice->memo }}</p>
        </div>
    </div>

    <div class="buttons">
        <a href="/practices/{{ $practice->id }}/edit" class="btn-edit">Edit</a>
        <a href="{{ route('practices.index') }}" class="btn-back">Back</a>
    </div>
</body>

</html>