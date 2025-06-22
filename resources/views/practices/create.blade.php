<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>練習記録作成</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>練習記録作成</h1>

    <form action="/practices" method="POST">
        @csrf

        <label>日付：
            <input type="date" name="date">
        </label>

        <label>練習時間：
            <input type="text" name="time">
        </label>

        <label>使用楽器：
            <input type="text" name="instrument">
        </label>

        <label>音楽ジャンル：
            <input type="text" name="genre">
        </label>

        <label>練習内容：
            <textarea name="content" rows="4"></textarea>
        </label>

        <label>振り返り：
            <textarea name="reflection" rows="4"></textarea>
        </label>

        <label>次回の目標：
            <input type="text" name="next_goal">
        </label>

        <label>メモ：
            <textarea name="memo" rows="3"></textarea>
        </label>

        <input type="submit" value="保存">
    </form>
</body>

</html>