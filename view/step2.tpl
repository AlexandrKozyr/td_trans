<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">

        <title>Каталог</title>
        <link rel="stylesheet" href="css/selectbox.css">
        <link rel="stylesheet" href="css/step2.css">

        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/selectbox.js" type="text/javascript"></script>



    </head>
    <body>
        <div style="margin: 0 auto; width: 92%;">
            <div class="car_check">
                <div class="car_check_title">Поиск модели вашего автомобиля</div>
                <div class="car_check_sub_header">Выбор вашего автомобиля</div>
                <div class="car_check_body">
                    <div class="carpartsNavigation">
                        <form>

                            <div class="carpartsNavigationControls">
                                <select class="carMfr" name="carMfr" id="carMfr" onchange="selectcars('vendor', 'carMfr');">
                                    <option value="0">Выберите производителя</option>
                                    {foreach $mfrList as $item}
                                        {foreach $item as $value}
                                            {if $value == $curMfr}
                                                <option  selected value="{$value}">{$value}</option>
                                            {else}
                                                <option value="{$value}">{$value}</option>
                                            {/if}
                                        {/foreach}
                                    {/foreach}
                                </select>
                            </div>
                            <div class="carpartsNavigationControls">
                                <select class="carModel" name="carModel" id="carModel" onchange="selectcars('model', 'carModel');">
                                    <option value="0">Выберите модель</option>
                                    {foreach $modList as $value }
                                        <option value="{$value[0]}">{$value[1]}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="carpartsNavigationControls">
                                <select class="carType" name="carType" id="carType" onchange="selectcars('type', 'carType');">
                                    <option value="0">Выберите модификацию</option>
                                </select>
                            </div>
                        </form>
                        <div class="btn_choose">
                            <a><img src="img/choose_btn.png"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps">
                <table style="border: 0;font: 'Segoe UI';"><tbody>
                        <tr>
                            <td><img src="img/1.png"></td>
                            <td style="background: #FFEEA7; width: 267px;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 1</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите марку и модель своего автомобиля</div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/2.png"></td>
                            <td style="background: #FFDE46;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 2</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите тип запчасти из каталога</div>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="img/3.png"></td>
                            <td style="background: #FF9D00;">
                                <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 3</div>
                                <div style="font-size: 16px; padding: 10px 10px 0 10px;">Получите запчасти и аналоги для вашего автомобиля</div>
                            </td>
                        </tr>
                    </tbody></table>
            </div> 
        </div>
        <script src="js/step2.js" type="text/javascript"></script>
        <div id='cssmenu'>
            asdjkadljlkdsasld
        </div>	
    </div> 	
</body>
</html>