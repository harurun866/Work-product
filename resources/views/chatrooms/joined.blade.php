<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>参加中のチャットルーム</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 2rem auto;
            max-width: 760px;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            /* 淡いピンクと紫のグラデ */
            color: #000;
        }

        h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .chatroom-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.2rem;
        }

        .chatroom-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .chatroom-card h2 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .chatroom-card p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .chatroom-card a {
            background-color: #f8bbd0;
            color: #000;
            font-weight: 600;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s ease;
        }

        .chatroom-card a:hover {
            background-color: #f48fb1;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
        }

        .footer a {
            padding: 0.5rem 1rem;
            background-color: #d1c4e9;
            color: #000;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
        }

        .footer a:hover {
            background-color: #b39ddb;
        }
    </style>
</head>

<body>
    <h1>参加中のチャットルーム一覧</h1>

    <div class="chatroom-list">
        @forelse ($joinedChatrooms as $room)
        <div class="chatroom-card">
            <h2>{{ $room->name }}</h2>
            <p>{{ $room->room_description ?? '（説明はありません）' }}</p>
            <a href="{{ route('chatrooms.show', $room->id) }}">チャットへ</a>
        </div>
        @empty
        <p>参加中のチャットルームはありません。</p>
        @endforelse
    </div>

    <div class="footer">
        <a href="{{ route('chatrooms.index') }}">← 一覧に戻る</a>
    </div>
</body>

</html>