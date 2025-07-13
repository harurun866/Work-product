// calendar.js

import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

// カレンダーを表示させたいタグのidを取得
const calendarEl = document.getElementById("calendar");

// new Calender(カレンダーを表示させたいタグのid, {各種カレンダーの設定});
// "calendar"というidがないbladeファイルではエラーが出てしまうので、if文で除外。
if (calendarEl) {
    const calendar = new Calendar(calendarEl, {
        // プラグインの導入(import忘れずに)
        plugins: [dayGridPlugin, timeGridPlugin],

        // カレンダー表示
        initialView: "dayGridMonth", // 最初に表示させるページの形式
        customButtons: {
            eventAddButton: {
                text: "予定を追加",
                click: function () {
                    // 初期化（以前入力した値をクリアする）
                    document.getElementById("body").value = "";
                    document.getElementById("date").value = "";
                    document.getElementById("is_planned").value = "0";

                    // モーダルを表示
                    document.getElementById("modal-add").style.display = "flex";
                },
            },
        },

        headerToolbar: {
            // ヘッダーの設定
            // コンマのみで区切るとページ表示時に間が空かず、半角スペースで区切ると間が空く（半角があるかないかで表示が変わることに注意）
            start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
            center: "title", // ヘッダー中央（今表示している月、年）
            end: "eventAddButton dayGridMonth,timeGridWeek", // ヘッダー右（月形式、時間形式）
        },
        height: "auto", // 高さをウィンドウサイズに揃える
    });

    // カレンダーのレンダリング
    calendar.render();
    window.closeAddModal = function () {
        document.getElementById("modal-add").style.display = "none";
    };
}
