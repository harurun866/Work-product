<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Practice Log</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            margin-bottom: 1.5rem;
            text-align: center;
            color: #000000;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .button-group {
            margin-top: 2rem;
            text-align: center;
        }

        .button-group button,
        .button-group a {
            display: inline-block;
            padding: 0.7rem 1.5rem;
            margin: 0 0.5rem;
            border-radius: 30px;
            font-size: 1rem;
            text-decoration: none;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-submit {
            background-color: #f8d7da;
            color: #000000;
            box-shadow: 0 5px 18px rgba(248, 215, 218, 0.6);
        }

        .btn-submit:hover {
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
    <form action="/practices" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date：</label>
            <input type="date" name="date" id="date">
        </div>

        <div class="form-group">
            <label for="duration">Duration:</label>
            <div style="display: flex; gap: 1rem;">
                <div>
                    <label for="hours">Hour</label>
                    <input type="number" name="hours" id="hours" min="0" max="23" value="{{ old('hours', 0) }}">
                </div>
                <div>
                    <label for="minutes">Minute</label>
                    <input type="number" name="minutes" id="minutes" min="0" max="59" value="{{ old('minutes', 0) }}">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="instrument">Instrument：</label>
            <input type="text" name="instrument" id="instrument">
        </div>

        <div class="form-group">
            <label for="genre">Genre：</label>
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

        <div class="button-group">
            <button type="submit" class="btn-submit">Record</button>
            <a href="/practices" class="btn-back">Back</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date", {
            dateFormat: "Y-m-d",
            locale: "en",
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true
        });
    </script>
</body>

</html>