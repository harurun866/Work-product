<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>Community</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 2rem 0;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
            color: #000;
        }

        .container {
            max-width: 880px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .joined-button-container {
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .joined-button {
            background-color: #f8bbd0;
            color: #000;
            font-weight: 700;
            padding: 0.5rem 1.2rem;
            border: none;
            border-radius: 20px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .joined-button:hover {
            background-color: #f48fb1;
        }

        .chatrooms {
            display: grid;
            grid-template-columns: repeat(3, minmax(295px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }

        @media (max-width: 980px) {
            .chatrooms {
                grid-template-columns: repeat(2, minmax(295px, 1fr));
            }
        }

        @media (max-width: 650px) {
            .chatrooms {
                grid-template-columns: 1fr;
            }
        }

        .chatroom-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 12px 25px rgba(2, 119, 189, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
        }

        .chatroom-image {
            height: 120px;
            background-color: #b2ebf2;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .chatroom-image a.edit-button {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background-color: #0288d1;
            color: white;
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
            border-radius: 12px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
            transition: background-color 0.3s ease;
            white-space: nowrap;
        }

        .chatroom-image a.edit-button:hover {
            background-color: #0277bd;
        }

        .chatroom-body {
            padding: 1rem;
        }

        .chatroom-body h2 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .chatroom-body p {
            font-size: 0.9rem;
            color: #444;
            margin-bottom: 0.8rem;
        }

        .chatroom-body form button,
        .chatroom-body a.enter-button {
            font-weight: 700;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .chatroom-body a.enter-button {
            background-color: #ccc;
            color: #000;
            text-decoration: none;
        }

        .chatroom-body a.enter-button:hover {
            background-color: #bbb;
        }

        .chatroom-body form button.join-button {
            background-color: #0288d1;
            color: #fff;
        }

        .chatroom-body form button.join-button:hover {
            background-color: #0277bd;
        }

        .chatroom-body form button.leave-button {
            background-color: #e57373;
            color: #fff;
            margin-left: 0.5rem;
        }

        .chatroom-body form button.leave-button:hover {
            background-color: #d32f2f;
        }

        .new-group {
            border: 2px dashed #90caf9;
            border-radius: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 1.1rem;
            color: #1976d2;
            text-decoration: none;
            padding: 2rem;
            margin: 2rem 0 0 0;
        }

        .new-group:hover {
            background-color: #e3f2fd;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Community</h1>

        <div class="joined-button-container">
            <a href="{{ route('chatrooms.joined') }}" class="joined-button">参加中のルーム一覧</a>
        </div>

        <div class="chatrooms">
            @forelse ($chatrooms as $room)
            <div class="chatroom-card">
                <div class="chatroom-image" style="background-image: url('{{ $room->image_url ?? '/default.jpg' }}');">
                    @if ($room->user_id === auth()->id())
                    <a href="{{ route('chatrooms.edit', $room->id) }}" class="edit-button">グループ情報の編集</a>
                    @endif
                </div>
                <div class="chatroom-body">
                    <h2>{{ $room->name }}</h2>
                    <p>{{ $room->room_description ?? '（説明はありません）' }}</p>

                    @if (in_array($room->id, $joinedRoomIds))
                    <a href="{{ route('chatrooms.show', $room->id) }}" class="enter-button">入室する</a>
                    @else
                    <form action="{{ route('chatrooms.join', $room->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="join-button">参加</button>
                    </form>
                    @endif
                </div>
            </div>
            @empty
            <p>チャットルームがまだ作成されていません。</p>
            @endforelse

            <a href="{{ route('chatrooms.create') }}" class="new-group">+New Group</a>
        </div>

        <div class="footer">
            <a href="/">Back</a>
        </div>
    </div>
</body>

</html>