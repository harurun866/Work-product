<x-app-layout>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />

        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <style>
        /* Home全体の背景（水色グラデ） */
        html,
        body,
        .min-h-screen {
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe) !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .app-card {
            background: #fffde7;
            /* 淡い黄色 */
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .app-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #8d6e00;
            /* 黄土色寄り */
            margin-bottom: 0.5rem;
        }

        .catch-copy {
            font-size: 1rem;
            color: #6f4e00;
            margin-bottom: 0.3rem;
        }

        .sub-copy {
            font-size: 0.9rem;
            color: #a18800;
            margin-bottom: 1rem;
        }

        #calendar-container {
            background: #fffde7;
            border: 1px solid #fbc02d;
            border-radius: 10px;
            padding: 1rem;
            max-width: 900px;
            /* カレンダー全体の最大幅を広げる */
            margin: 0 auto;
        }

        /* --- FullCalendar カスタム --- */
        .fc {
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            color: #5d4037;
            background: #fffde7;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .fc-toolbar-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #fbc02d;
            margin-bottom: 12px;
        }

        .fc-button {
            background-color: #ffeb3b;
            border: none;
            border-radius: 8px;
            color: #5d4037;
            font-weight: 600;
            padding: 6px 14px;
            box-shadow: none;
            transition: background-color 0.3s;
        }

        .fc-button:hover,
        .fc-button:focus {
            background-color: #fbc02d;
            outline: none;
            color: #3e2723;
        }

        /* 曜日・日付のセルサイズを大きく */
        .fc-daygrid-day {
            border-radius: 10px;
            border: 1px solid #fff59d;
            transition: background-color 0.2s;

            min-width: 120px;
            /* 幅 */
            min-height: 120px;
            /* 高さ */
            padding: 10px;
        }

        .fc-daygrid-day:hover {
            background-color: #81d4fa;
            cursor: pointer;
        }

        .fc-day-today {
            background-color: #fff176;
            border-radius: 10px;
        }

        /* 予定タイトルの文字色を黒に */
        .fc-daygrid-event {
            background-color: #f9a825;
            border: none;
            border-radius: 8px;
            padding: 3px 6px;
            font-weight: 600;
            color: #000;
            /* ここを黒に */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .fc-daygrid-event:hover {
            background-color: #f57f17;
            cursor: pointer;
        }

        .fc-col-header-cell-cushion {
            font-weight: 700;
            color: #fbc02d;
        }

        .fc-timegrid-slot-label {
            color: #fbc02d;
            font-weight: 600;
        }

        /* モーダルのオーバーレイ */
        .modal {
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* モーダル本体 */
        .modal-contents {
            background-color: #fffde7;
            width: 500px;
            padding: 24px 32px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            color: #5d4037;
        }

        input[type="text"],
        /* Flatpickrで使用するためtype=textを含む */
        input[type="date"],
        textarea,
        select {
            display: block;
            width: 100%;
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid #fbc02d;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            background-color: #fffde7;
            color: #5d4037;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        select {
            width: 50%;
        }

        .modal-contents form {
            margin-bottom: 12px;
        }

        .modal-contents form button {
            padding: 6px 12px;
            margin-right: 8px;
            background-color: #fff176;
            color: #5d4037;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .modal-contents form button:hover {
            background-color: #fbc02d;
        }

        .modal-contents form button.delete {
            background-color: #ef9a9a;
            color: #7f0000;
        }

        .modal-contents form button.delete:hover {
            background-color: #b71c1c;
            color: #fff;
        }

        .button-row {
            display: flex;
            justify-content: flex-start;
            gap: 8px;
        }

        .fc-event-title-container {
            cursor: pointer;
        }
    </style>

    <body>
        <div class="min-h-screen py-4">
            <div class="max-w-7xl mx-auto px-4">
                <div class="app-card text-center">
                    <div class="app-title">Oto Nest♪</div>
                    <div class="catch-copy">音楽の練習を、もっと楽しく、もっとつながる。</div>
                    <p class="sub-copy">Support your music habits with Oto Nest. Record your practice and stay motivated with your peers.</p>

                    <div id="calendar-container">
                        <div id="calendar"></div>

                        <!-- 予定追加モーダル -->
                        <div id="modal-add" class="modal">
                            <div class="modal-contents">
                                <form method="POST" action="{{ route('create') }}">
                                    @csrf
                                    <label for="body">予定内容</label>
                                    <textarea id="body" name="body" rows="3" class="input-title" placeholder="内容を入力してください"></textarea>

                                    <label for="date">日付</label>
                                    <!-- type="text"にしてFlatpickr対応 -->
                                    <input type="text" id="date" name="date" class="input-date" placeholder="Select date" />

                                    <label for="is_planned">予定の有無</label>
                                    <select name="is_planned" id="is_planned" class="input-date">
                                        <option value="1">予定あり</option>
                                        <option value="0" selected>予定なし</option>
                                    </select>

                                    <div class="button-row">
                                        <button type="button" onclick="closeAddModal()">キャンセル</button>
                                        <button type="submit">登録</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- 予定編集モーダル -->
                        <div id="modal-update" class="modal">
                            <div class="modal-contents">
                                <form method="POST" action="{{ route('update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" id="update_id" name="id" value="" />

                                    <label for="update_body">予定内容</label>
                                    <textarea id="update_body" name="body" rows="3" class="input-title" placeholder="内容を入力してください"></textarea>

                                    <label for="update_date">日付</label>
                                    <!-- type="text"にしてFlatpickr対応 -->
                                    <input type="text" id="update_date" name="date" class="input-date" placeholder="Select date" />

                                    <label for="update_is_planned">予定の有無</label>
                                    <select name="is_planned" id="update_is_planned" class="input-date">
                                        <option value="1">予定あり</option>
                                        <option value="0">予定なし</option>
                                    </select>

                                    <div class="button-row">
                                        <button type="button" onclick="closeUpdateModal()">キャンセル</button>
                                        <button type="submit">更新</button>
                                        <button class="delete" type="button" onclick="deleteEvent()">削除</button>
                                    </div>
                                </form>

                                <form id="delete-form" method="POST" action="{{ route('delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" id="delete-id" name="id" value="" />
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script>
            // 予定追加モーダルのFlatpickr初期化
            flatpickr("#date", {
                dateFormat: "Y-m-d",
                locale: "en",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: true
            });

            // 予定編集モーダルのFlatpickr初期化
            flatpickr("#update_date", {
                dateFormat: "Y-m-d",
                locale: "en",
                altInput: true,
                altFormat: "F j, Y",
                allowInput: true
            });

            window.closeAddModal = function() {
                document.getElementById("modal-add").style.display = "none";
            };

            window.closeUpdateModal = function() {
                document.getElementById("modal-update").style.display = "none";
            };

            function deleteEvent() {
                if (confirm("本当に削除しますか？")) {
                    const id = document.getElementById("update_id").value;
                    document.getElementById("delete-id").value = id;
                    document.getElementById("delete-form").submit();
                }
            }
        </script>
    </body>
</x-app-layout>