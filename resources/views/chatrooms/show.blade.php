<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{{ $chatroom->name }}</title>
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

        .chatroom-box {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 12px 25px rgba(2, 119, 189, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .chatroom-description {
            font-size: 1rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .message-form {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
        }

        .message-form input[type="text"] {
            flex-grow: 1;
            padding: 0.5rem;
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .message-form button {
            padding: 0.5rem 1.2rem;
            background-color: #0288d1;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .message-form button:hover {
            background-color: #0277bd;
        }

        .message-list {
            background-color: #ffffff;
            border-radius: 14px;
            padding: 1rem;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .message-item {
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 14px;
            padding: 1rem;
            position: relative;
        }

        .message-item strong {
            font-weight: 700;
        }

        .edit-controls {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
        }

        .edit-controls button,
        .edit-form button {
            border: none;
            padding: 0.3rem 0.9rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            margin: 0.3rem 0.2rem;
            cursor: pointer;
            color: #000;
        }

        .edit-form input[type="text"] {
            width: 100%;
            padding: 0.5rem;
            border-radius: 14px;
            border: 1px solid #ccc;
            margin: 0.5rem 0;
        }

        /* 保存ボタン */
        .btn-save {
            background-color: #81c784;
        }

        /* キャンセルボタン */
        .btn-cancel {
            background-color: #90caf9;
        }

        /* 削除ボタン */
        .btn-delete {
            background-color: #e57373;
        }

        .back-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #6c757d;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            text-align: center;
        }

        .back-link:hover {
            background-color: #495057;
        }

        .status-button {
            background-color: #ffd54f;
            color: #000;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .status-button.active {
            background-color: #aed581;
        }
    </style>
</head>

<body>
    <h1>{{ $chatroom->name }}</h1>

    <div class="chatroom-box">
        <div class="chatroom-description">
            {{ $chatroom->room_description ?? '（説明はありません）' }}
        </div>

        <div style="text-align: right;">
            @php $pivot = $chatroom->users->find(auth()->id())->pivot ?? null; @endphp
            @if ($pivot && $pivot->status === 'active')
            <form action="{{ route('chatrooms.away', $chatroom->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="status-button">離席する</button>
            </form>
            @elseif ($pivot && $pivot->status === 'away')
            <form action="{{ route('chatrooms.active', $chatroom->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="status-button active">復帰する</button>
            </form>
            @endif
        </div>

        <form method="POST" action="{{ route('chats.post', $chatroom->id) }}" class="message-form">
            @csrf
            <input type="text" name="body" placeholder="メッセージを入力..." required autocomplete="off">
            <button type="submit">送信</button>
        </form>

        <div class="message-list">
            @forelse ($messages as $message)
            @php
            $user = $message->user;
            $status = $chatroom->users->find($user->id)->pivot->status ?? 'active';
            @endphp
            <div class="message-item" data-message-id="{{ $message->id }}">
                <div class="edit-controls">
                    @if ($message->user_id === auth()->id())
                    <button onclick="toggleEdit({{ $message->id }})">編集</button>
                    @endif
                </div>

                <strong>
                    {{ $user->name }}
                    @if ($status === 'away')<span style="font-size: 0.8rem; color: #888;">（離席中）</span>@endif
                </strong>
                <div class="message-text">{{ $message->message }}</div>

                @if ($message->user_id === auth()->id())
                <form class="edit-form" style="display: none;" onsubmit="return false;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="message" value="{{ $message->message }}">
                    <div>
                        <button type="button" onclick="submitEdit({{ $message->id }})" class="btn-save">保存</button>
                        <button type="button" onclick="cancelEdit({{ $message->id }})" class="btn-cancel">キャンセル</button>
                        <button type="button" onclick="deleteMessage({{ $message->id }})" class="btn-delete">削除</button>
                    </div>
                </form>
                @endif
            </div>
            @empty
            <p>まだメッセージはありません。</p>
            @endforelse
        </div>
    </div>

    <div style="text-align: center;">
        <a href="{{ route('chatrooms.index') }}" class="back-link">← チャット一覧に戻る</a>
    </div>

    <script>
        function toggleEdit(id) {
            const item = document.querySelector(`.message-item[data-message-id="${id}"]`);
            item.querySelector('.message-text').style.display = 'none';
            item.querySelector('.edit-form').style.display = 'block';
        }

        function cancelEdit(id) {
            const item = document.querySelector(`.message-item[data-message-id="${id}"]`);
            item.querySelector('.edit-form').style.display = 'none';
            item.querySelector('.message-text').style.display = 'block';
        }

        function submitEdit(id) {
            const item = document.querySelector(`.message-item[data-message-id="${id}"]`);
            const input = item.querySelector('input[name="message"]');
            const token = document.querySelector('input[name="_token"]').value;

            fetch(`/chats/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    body: JSON.stringify({
                        message: input.value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    item.querySelector('.message-text').textContent = data.message;
                    cancelEdit(id);
                })
                .catch(err => {
                    alert('更新に失敗しました。');
                    console.error(err);
                });
        }

        function deleteMessage(id) {
            if (!confirm('本当にこのメッセージを削除しますか？')) return;
            const token = document.querySelector('input[name="_token"]').value;

            fetch(`/chats/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    if (res.ok) {
                        const item = document.querySelector(`.message-item[data-message-id="${id}"]`);
                        item.remove();
                    } else {
                        alert('削除に失敗しました');
                    }
                });
        }
    </script>
</body>

</html>