<x-app-layout>


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        html,
        body,
        .min-h-screen {
            background: linear-gradient(135deg, #e0f7fa, #e1f5fe) !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .app-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .app-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #000;
            margin-bottom: 0.5rem;
        }

        .catch-copy {
            font-size: 1rem;
            color: #333;
            margin-bottom: 0.3rem;
        }

        .sub-copy {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 1rem;
        }

        #calendar-container {
            background: #f9fafb;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 1rem;
        }
    </style>

    <body>
        <div class="min-h-screen py-4">
            <div class="max-w-3xl mx-auto px-4">
                <div class="app-card text-center">

                    <div class="app-title">Oto Nest♪</div>
                    <div class="catch-copy">音楽の練習を、もっと楽しく、もっとつながる。</div>
                    <p class="sub-copy">Support your music habits with Oto Nest. Record your practice and stay motivated with your peers.</p>

                    <div id="calendar-container">
                        <div id="calendar"></div>
                        <div id="modal-add" class="modal">
                            <div class="modal-contents">
                                <form method="POST" action="{{ route('create')  }}">
                                    @csrf
                                    <label for="body">予定内容</label>
                                    <textarea id="body" name="body" rows="3" class="input-title" placeholder="内容を入力してください"></textarea>

                                    <label for="date">日付</label>
                                    <input type="date" id="date" name="date" class="input-date" />

                                    <label for="is_planned">予定の有無</label>
                                    <select name="is_planned" id="is_planned" class="input-date">
                                        <option value="1">予定あり</option>
                                        <option value="0" selected>予定なし</option>
                                    </select>

                                    <button type="button" onclick="closeAddModal()">キャンセル</button>
                                    <button type="submit">登録</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>

    <style scoped>
        /* モーダルのオーバーレイ */
        .modal {
            display: none;
            /* 初期は非表示（JSで display:flex に切り替え） */
            justify-content: center;
            align-items: center;
            position: fixed;
            /* fixed に変更するとスクロールしても中央表示を保てる */
            z-index: 1000;
            /* カレンダーより前面に出す */
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
            background-color: #fff;
            width: 500px;
            padding: 24px 32px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);

        }

        /* 各フォーム項目の共通デザイン */
        input[type="text"],
        input[type="date"],
        textarea,
        select {
            display: block;
            width: 100%;
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* テキストエリアだけ高さ調整 */
        textarea {
            resize: none;
            height: 80px;
        }

        /* セレクトだけ少し小さめに（任意） */
        select {
            width: 50%;
        }

        /* ボタンデザイン */
        button {
            padding: 8px 16px;
            margin-right: 10px;
            background-color: #9ca3af;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #6b7280;
        }

        /* キャンセルボタンはグレー */
        button[type="button"] {
            background-color: #9ca3af;
        }

        button[type="button"]:hover {
            background-color: #6b7280;
        }
    </style>
    <!-- （ここまで） -->

</x-app-layout>