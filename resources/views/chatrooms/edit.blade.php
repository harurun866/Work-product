<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Edit Chatroom</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
            max-width: 760px;
            margin: 2rem auto;
            padding: 1.5rem;
            color: #000;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
        }

        form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 14px;
            box-shadow: 0 12px 25px rgba(2, 119, 189, 0.1);
        }

        label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1rem;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #0288d1;
            color: #fff;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 30px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #0277bd;
        }

        .footer {
            margin-top: 2rem;
            text-align: center;
        }

        .footer a {
            text-decoration: none;
            color: #0288d1;
            font-weight: 700;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <h1>Edit Chatroom</h1>

    <form action="{{ route('chatrooms.update', $chatroom->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Group Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $chatroom->name) }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror

        <label for="room_description">About</label>
        <textarea id="room_description" name="room_description" rows="4">{{ old('room_description', $chatroom->room_description) }}</textarea>
        @error('room_description')
        <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Update</button>
    </form>

    <div class="footer">
        <a href="{{ route('chatrooms.index') }}">← Back to Community</a>
    </div>
</body>

</html>