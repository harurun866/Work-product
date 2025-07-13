// calendar.js

import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

function formatDate(date, pos) {
    const dt = new Date(date);
    if (pos === "end") {
        dt.setDate(dt.getDate() - 1);
    }
    return (
        dt.getFullYear() +
        "-" +
        ("0" + (dt.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + dt.getDate()).slice(-2)
    );
}

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

        //（ここから）追記
        // DBに登録した予定を表示する
        events: function (info, successCallback, failureCallback) {
            // eventsはページが切り替わるたびに実行される
            // axiosでLaravelの予定取得処理を呼び出す
            axios
                .post("/dashboard/get", {
                    // 現在カレンダーが表示している日付の期間(1月ならば、start_date=1月1日、end_date=1月31日となる)
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),
                })
                .then((response) => {
                    // 既に表示されているイベントを削除（重複防止）
                    calendar.removeAllEvents(); // ver.6でもどうやら使える（ドキュメントにはない？）
                    // カレンダーに読み込み
                    successCallback(response.data); // successCallbackに予定をオブジェクト型で入れるとカレンダーに表示できる
                })
                .catch((error) => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました。");
                });
        },
        // （ここまで）
        eventClick: function (info) {
            document.getElementById("update_id").value = info.event.id;
            document.getElementById("delete-id").value = info.event.id;
            document.getElementById("update_body").value = info.event.title;
            document.getElementById("update_date").value = formatDate(
                info.event.start
            );

            // is_plannedはeventのextendedPropsに入れてある想定
            document.getElementById("update_is_planned").value = info.event
                .extendedProps.is_planned
                ? "1"
                : "0";

            // 予定編集モーダルを開く
            document.getElementById("modal-update").style.display = "flex";
        },
    });

    // カレンダーのレンダリング
    calendar.render();
    window.closeAddModal = function () {
        document.getElementById("modal-add").style.display = "none";
    };

    window.closeUpdateModal = function () {
        document.getElementById("modal-update").style.display = "none";
    };

    window.deleteEvent = function () {
        "use strict";

        if (confirm("削除すると復元できません。\n本当に削除しますか？")) {
            document.getElementById("delete-form").submit();
        }
    };
}
