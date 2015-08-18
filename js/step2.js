$('select.carMfr').selectbox();
$('select.carModel').selectbox();
$('select.carType').selectbox();



var section_url = 'tires';
var last_mode = '';

function selectcars(mode, select)
{
    last_mode = mode;
    var value = $("#" + select + "").val();

    switch (mode)
    {
        case "vendor":
            $(".btn_choose a img").css("cursor", "no-drop");
            if (value == 0) {
                $("#carModel").empty();
                $("#carModel").append($('<option value="0">Выберите модель</option>'));
                $("#carModel").prev().remove();
                $("#carModel").selectbox();
                $("#cssmenu").html("");
                $("#carType").empty();
                $("#carType").append($('<option value="0">Выберите модификацию</option>'));
                $("#carType").prev().remove();
                $("#carType").selectbox();
                $("#cssmenu").css("visibility", "hidden");
            }

            $.ajax({
                type: "POST",
                url: "/index.php",
                data: 'ajax=1&brand=' + value,
                dataType: "json",
                success: function (data) {

                    $("#carModel").empty();
                    $("#carModel").append($('<option value="0">Выберите модель</option>'));

                    for (var i = 0; i < data.length; i++)
                    {
                        $("#carModel").append($('<option value="' + data[i][0] + '">' + data[i][1] + '</option>'));
                    }
                    $("#carModel").prev().remove();
                    $("#carModel").selectbox();
                    $("#cssmenu").html("");
                    $("#carType").empty();
                    $("#carType").append($('<option value="0">Выберите модификацию</option>'));
                    $("#carType").prev().remove();
                    $("#carType").selectbox();
                    $("#cssmenu").css("visibility", "hidden");
                }
            });
            break;
        case "model":
            $(".btn_choose a img").css("cursor", "no-drop");

            if (value == 0) {
                $("#cssmenu").html("");
                $("#carType").empty();
                $("#carType").append($('<option value="0">Выберите модификацию</option>'));
                $("#carType").prev().remove();
                $("#carType").selectbox();
                $("#cssmenu").css("visibility", "hidden");
            }

            $.ajax({
                type: "POST",
                url: "/index.php",
                data: 'ajax=2&modelId=' + value,
                dataType: "json",
                success: function (data) {

                    $("#carType").empty();
                    $("#carType").append($('<option value="0">Выберите модификацию</option>'));
                    for (var i = 0; i < data.length; i++)
                    {
                        $("#carType").append($('<option value="' + data[i][0] + '">' + data[i][1] + '</option>'));
                    }
                    $("#carType").prev().remove();
                    $("#carType").selectbox();
                    $("#cssmenu").html("");
                    $("#cssmenu").css("visibility", "hidden");
                }
            });
            break;

        case "type":
            if (value != 0) {
                $(".btn_choose a img").css("cursor", "pointer");
            } else {
                $(".btn_choose a img").css("cursor", "no-drop");
            }
            $("#cssmenu").html("");
            $("#cssmenu").css("visibility", "hidden");
            break;
    }

}


$(".btn_choose a img").click(function ()
{
    if ($(".btn_choose a img").css("cursor") == "pointer") {
        $("#cssmenu").css("visibility", "visible");
        $.ajax({
            type: "POST",
            url: "/index.php",
            data: 'ajax=3&typeId=' + $("#carType").val(),
            dataType: "text",
            success: function (data) {
                $("#cssmenu").html(data);
            }
        });
    }
});






