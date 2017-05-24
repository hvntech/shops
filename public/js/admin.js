$("input[data-preview]").on("change", function() {
    var imageFile = $(this).prop("files")[0];
    var fr = new FileReader();
    var target = $(this).data("preview");
    fr.onload = function() {
        $("#" + target).attr("src", fr.result);
    };
    fr.readAsDataURL(imageFile);
});

$("#datetimepickerfrom").datetimepicker({
    format: "DD/MM/Y HH:mm",
}).on("dp.change", function (e) {
    $("#datetimepickerto").data("DateTimePicker").minDate(e.date);
    $(this).data("DateTimePicker").hide();
});
$("#datetimepickerto").datetimepicker({
    format: "DD/MM/Y HH:mm",
}).on("dp.change", function (e) {
    $("#datetimepickerfrom").data("DateTimePicker").maxDate(e.date);
    $(this).data("DateTimePicker").hide();
});

$("#datepickerfrom").datetimepicker({
    format: "Y/MM/DD",
    minDate: new Date().setFullYear((new Date().getFullYear() - 1)),
    maxDate: $.now()
}).on("dp.change", function (e) {
    $("#datepickerto").data("DateTimePicker").minDate(e.date);
    $(this).data("DateTimePicker").hide();
});

$("#datepickerto").datetimepicker({
    format: "Y/MM/DD",
    maxDate: $.now()
}).on("dp.change", function (e) {
    $("#datepickerfrom").data("DateTimePicker").maxDate(e.date);
    $(this).data("DateTimePicker").hide();
});

$("#monthpickerfrom").datetimepicker({
    format: "Y/MM",
    minDate: new Date().setFullYear((new Date().getFullYear() - 30)),
    maxDate: $.now()
}).on("dp.change", function (e) {
    $("#monthpickerto").data("DateTimePicker").minDate(e.date);
    $(this).data("DateTimePicker").hide();
});
$("#monthpickerto").datetimepicker({
    format: "Y/MM",
    maxDate: $.now()
}).on("dp.change", function (e) {
    $("#monthpickerfrom").data("DateTimePicker").maxDate(e.date);
    $(this).data("DateTimePicker").hide();
});

