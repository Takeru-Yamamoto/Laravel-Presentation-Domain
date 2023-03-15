import * as f from "./functions";

$(function ($) {
    $(".sortable").sortable({
        connectWith: '.sortable'
    });

    $(".sortable").disableSelection();

    $(document).on("click", ".search-address-prefecture-postcode-btn", function () {
        var postCodeInput = $(this).data("postCodeInput");
        var addressInput = $(this).data("addressInput");
        var prefectureSelect = $(this).data("prefectureSelect");

        var url = "https://zipcloud.ibsnet.co.jp/api/search";

        var postCode = $("#" + postCodeInput).val();

        if (postCode) {
            f.startSpinner();

            var callback = function (response) {
                f.stopSpinner();

                var result = response.results[0];

                $("#" + postCodeInput).val(result.zipcode.slice(0, 3) + "-" + result.zipcode.slice(-4));
                $("#" + addressInput).val(result.address1 + result.address2 + result.address3);
                if (prefectureSelect) $("#" + prefectureSelect).prop('selectedIndex', result.prefcode);
            }

            var setting = {
                url: url,
                type: "GET",
                cache: false,
                dataType: "json",
                data: {
                    zipcode: postCode
                },
            };

            f.fullSettingAjaxRequest(setting, callback);
        }
    });

    $(document).on("keyup", ".search-input", function () {
        var value = $(this).val();

        var url = $(this).data("url");
        var model = $(this).data("model");
        var eloquent = $(this).data("eloquent");
        var from = $(this).data("from");
        var to = $(this).data("to");
        var limit = $(this).data("limit");
        var additional = $(this).data("additional");

        var data = {
            value: value,
            model: model,
            eloquent: eloquent,
            from: from,
            to: to,
            limit: limit,
            additional: additional
        };

        var duplicateCount = $(this).data("duplicateCount");

        var callback = function (response) {
            var html = "";

            html += "<div class='card'>"
            html += "<div class='card-header'>検索結果 (最大" + limit + "件)</div>"
            html += "<div class='card-body'>"
            html += "<div class='list-group'>"

            if (response.length) {
                for (var result of response) {
                    html += "<a class='list-group-item list-group-item-action search-result' data-model='" + model + "' data-from='" + from + "' data-to='" + to + "' data-duplicate-count='" + duplicateCount + "' data-value='" + result["to"] + "'>" + result["from"] + "</li>";
                }
            } else {
                html += "<p class='m-0'>検索結果がありません。</p>";
            }

            html += "</div></div></div>";

            $("#search-result" + duplicateCount).html(html);
        }

        if (value) f.jsonAjaxRequest(url, "POST", data, callback);
    });

    $(document).on("click", ".search-result", function () {
        var model = $(this).data("model");
        var from = $(this).data("from");
        var to = $(this).data("to");
        var value = $(this).data("value");
        var duplicateCount = $(this).data("duplicateCount");

        $("#" + model + "_" + to).val(value);
        $("#" + model + "_" + from).val($(this).text());

        $("#search-result" + duplicateCount).html("");
    });

    $(document).on("change", ".colors-select", function () {
        var color = $(this).val();

        $(this).removeClass(function (index, className) {
            return (className.match(/\bbg-\S+/g) || []).join(' ');
        });
        $(this).addClass("bg-" + color);
    });

    $(document).on("click", ".logout-btn", function () {
        $("#logout-form").trigger("submit");
    });

    $(document).on("click", ".start-spinner-btn", function () {
        f.startSpinner();
    });

    $(document).on("click", ".stop-spinner-btn", function () {
        f.stopSpinner();
    });

    $(document).on("click", ".tooltip-original", function () {
        $(this).toggleClass("tooltip-active");
    });

    $(document).on("click", ".form-submit-btn", function () {
        var formId = $(this).data("form");

        $("#" + formId).trigger("submit");
    });

    $(document).on("click", ".modal-btn", function () {
        var modalId = $(this).data("modalId");
        $("#" + modalId).modal("show");
    });

    $(document).on("click", ".ajax-modal-btn", function () {
        var url = $(this).data("url");
        var type = $(this).data("type");
        var id = $(this).data("id");
        var modalId = $(this).data("modalId");

        var callback = function (result) {
            $(".modal-marks").html(result);
            $("#" + modalId).modal("show");
        }

        f.htmlAjaxRequest(url, type, { id: id }, callback);
    });

    $(document).on("click", ".accordion-header", function () {
        $(this).children(".accordion-close").removeClass("active");
        $(this).children(".accordion-open").removeClass("active");

        if ($(this).attr("aria-expanded") === "true") {
            $(this).children(".accordion-close").addClass("active");
        } else {
            $(this).children(".accordion-open").addClass("active");
        }
    });

    $(document).on("click", ".delete-btn", function () {
        var url = $(this).data("url");
        var id = $(this).data("id");

        if (confirm("該当項目を削除してよろしいですか？")) {
            var callback = function () {
                if (!alert("該当項目の削除に成功しました。")) {
                    location.reload();
                }
            }

            f.ajaxRequest(url, "POST", { id: id }, callback);
        }
    });

    $(document).on("click", ".flg-change-btn", function () {
        var url = $(this).data("url");
        var id = $(this).data("id");
        var flg = $(this).data("flg");

        var callback = function () {
            location.reload();
        }

        f.ajaxRequest(url, "POST", { id: id, flg: flg }, callback);
    });
});