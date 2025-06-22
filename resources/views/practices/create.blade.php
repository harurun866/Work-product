<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Practice Log</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 2rem;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        textarea {
            height: 120px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .section {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    <h1>Practice Log</h1>
    <div class="form-group">
        <label for="date">Date：</label><br>
        <input type="date" name="date" id="date">
    </div>

    <div class="form-group">
        <label for="duration">Practice Time：</label><br>
        <input type="text" name="duration" id="duration">
    </div>

    <div class="form-group">
        <label for="instrument">Instrument：</label><br>
        <input type="text" name="instrument" id="instrument">
    </div>

    <div class="form-group">
        <label for="genre">Genre：</label><br>
        <input type="text" name="genre" id="genre">
    </div>

    <div class="form-group">
        <label for="content">Practice Content：</label>
        <textarea name="content" id="content"></textarea>
    </div>

    <div class="form-group">
        <label for="reflection">Reflection：</label>
        <textarea name="reflection" id="reflection"></textarea>
    </div>

    <div class="form-group">
        <label for="next_goal">Next Goal：</label>
        <textarea name="next_goal" id="next_goal"></textarea>
    </div>

    <div class="form-group">
        <label for="memo">Memo：</label>
        <textarea name="memo" id="memo"></textarea>
    </div>

    <button type="submit">Record</button>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", {
            dateFormat: "Y-m-d", // サーバーに送る形式
            locale: "en",
            altInput: true, // ユーザーに見せる入力欄（代替表示）
            altFormat: "F j, Y", // 例：June 22, 2025
            allowInput: true
        });
    </script>
</body>

</html>