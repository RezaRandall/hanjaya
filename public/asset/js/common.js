$(document).ready(function () {
    onlyOneSelectedCheckBox();
    setNumberOnly();
    getDataPrice(function (data) {
        // calculate total price summary by input qty and selected checkbox price
        function calculateSum() {
            var prAgen = Number(data.item_price_agen);
            var prPenyalur = Number(data.item_price_penyalur);
            var prEceran = Number(data.item_price_eceran);
            var sumTotal = 0;
            var qty = $("#qty").val();
            // statement get total by selected checkbox
            if ($("#agenCbx").is(":checked") == true) {
                sumTotal += prAgen * qty;
            } else if ($("#penyalurCbx").is(":checked") == true) {
                sumTotal += prPenyalur * qty;
            } else if ($("#eceranCbx").is(":checked") == true) {
                sumTotal += prEceran * qty;
            }
            // var rp = "Rp. ";
            $("#totalPrice").val("Rp. " + sumTotal);
        }

        // auto change total by selected qty method
        $(".qtyInputNumber").on("keyup", function () {
            calculateSum();
        });
        // auto change total by selected agen price checkbox method
        $('input[name="chkAgen"]').on("change", function () {
            calculateSum();
        });
        // auto change total by selected penyalur price checkbox method
        $('input[name="chkPenyalur"]').on("change", function () {
            calculateSum();
        });
        // auto change total by selected eceran price checkbox method
        $('input[name="chkEceran"]').on("change", function () {
            calculateSum();
        });
        // auto change select option item name
        $("#itemNameSelected").attr("change", function () {
            var data = $(this).val();
            calculateSum(data);
        });
    });

    addingQtyItemMasterOnUpdate();
    // dataChart();
    addToBasket();
    deletedRowAfterAppend();
    // validationStartDateHigherThenEndDate();
}); // document ready function

function addingQtyItemMasterOnUpdate() {
    $("#addQty").on("change", function () {
        var getTotalQty =
            parseInt($("#qtyTotalUpdate").val()) + parseInt($("#addQty").val());
        $("#afterAddQtyTotal").val(getTotalQty);
    });
}

function getDataPrice(callback) {
    $(document).on("change", ".nameItem", function () {
        // get id by item Name
        var id = $(this).val();
        $.ajax({
            type: "get",
            url: "/findPrice",
            data: { item_id: id },
            dataType: "json", // return data will be json
            success: function (data) {
                var rp = "Rp. ";
                var qty = "in stock: ";
                $("#priceAgen").val(rp + data.item_price_agen);
                $("#pricePenyalur").val(rp + data.item_price_penyalur);
                $("#priceEceran").val(rp + data.item_price_eceran);
                $("#qtyReady").val(qty + data.item_quantity);

                callback(data);
            },
        });
    });
}

function setNumberOnly() {
    (function ($) {
        $.fn.inputFilter = function (inputFilter) {
            return this.on(
                "input keydown keyup mousedown mouseup select contextmenu drop",
                function () {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(
                            this.oldSelectionStart,
                            this.oldSelectionEnd
                        );
                    } else {
                        this.value = "";
                    }
                }
            );
        };
    })(jQuery);

    // Install input filters.
    $(".qtyInputNumber").inputFilter(function (value) {
        return /^-?\d*$/.test(value);
    });

    $(".numOnly").inputFilter(function (value) {
        return /^-?\d*$/.test(value);
    });
}

function onlyOneSelectedCheckBox() {
    $('input[type="checkbox"]').on("change", function () {
        $('input[type="checkbox"]').not(this).prop("checked", false);
    });
}

function addToBasket() {
    var selectItem = [];
    var qty = [];
    var uom = [];
    var selectedPrice = "";

    $(".addToBasket").on("click", function () {
        var itm = $("select.nameItem").val().split(":");
        var itm = itm[1];
        var qty = $("#qty").val();
        var uom = $("#uom").val();
        var tot = $("#totalPrice").val();

        if ($("#agenCbx").is(":checked") == true) {
            var selectedPrice = $("#priceAgen").val();
        } else if ($("#penyalurCbx").is(":checked") == true) {
            var selectedPrice = $("#pricePenyalur").val();
        } else if ($("#eceranCbx").is(":checked") == true) {
            var selectedPrice = $("#priceEceran").val();
        }
        var newRowAddToBasket = `<tr id=''>
                                    <td name='arrItem'>${itm}</td>
                                    <td>${qty}</td>
                                    <td>${uom}</td>
                                    <td>${selectedPrice}</td>
                                    <td>${tot}</td>
                                    <td><a class="btn btn-xs delete-record"><i class="glyphicon glyphicon-trash"></i></a></td>
                                </tr>`;
        $(newRowAddToBasket).appendTo($("#orderBasketAttributes"));
    });
}

function deletedRowAfterAppend() {
    $("#orderBasketAttributes").on("click", ".remRow", function () {
        $(this).parent("tr").remove();
    });
}

// function validationStartDateHigherThenEndDate() {
//     var startDate = new Date($("#dateStart").val());
//     var endDate = new Date($("#dateEnd").val());
//     $("#filter").on("click", function () {
//         if (startDate > endDate) {
//             alert("Start date cannot be higher than end date");
//         }
//     });
// }

// function dataChart() {
//     Highcharts.chart("chartSelling", {
//         chart: {
//             type: "column",
//         },
//         title: {
//             text: "Monthly Sales",
//         },
//         xAxis: {
//             categories: [
//                 "Jan",
//                 "Feb",
//                 "Mar",
//                 "Apr",
//                 "May",
//                 "Jun",
//                 "Jul",
//                 "Aug",
//                 "Sep",
//                 "Oct",
//                 "Nov",
//                 "Dec",
//             ],
//             crosshair: true,
//         },
//         yAxis: {
//             min: 0,
//             title: {
//                 text: "Terjual (liter)",
//             },
//         },
//         tooltip: {
//             headerFormat:
//                 '<span style="font-size:10px">{point.key}</span><table>',
//             pointFormat:
//                 '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//                 '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
//             footerFormat: "</table>",
//             shared: true,
//             useHTML: true,
//         },
//         plotOptions: {
//             column: {
//                 pointPadding: 0.2,
//                 borderWidth: 0,
//             },
//         },
//         series: [
//             {
//                 name: ["ghjagsfhgs"],
//                 data: [
//                     49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
//                     194.1, 95.6, 54.4,
//                 ],
//             },
//         ],
//     });
// }
