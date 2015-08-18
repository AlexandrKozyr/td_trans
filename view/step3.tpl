<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">
        <meta charset="utf-8">

        <title>Каталог</title>

        <link rel="stylesheet" href="css/step3.css">

    </head>
    <body>
        <div class="step3_container">
            <div class="auto_parts_category">Варианты запчастей для <span class="auto_parts_sub_category">{$carName}</span>
                <div class="edit_category"><a href="index.php?mfr={$mfrName}">Редактировать</a>
                </div>
            </div>

            <div class="table_autopats">

                {if count($result)>0}
                    <table>
                        <tr>
                            <td><div class="h_table_autopats">Фирма</div></td>
                            <td><div class="h_table_autopats">Артикул</div></td>
                            <td><div class="h_table_autopats">Описание</div></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="h_table_autopats_line" colspan="4"></td>
                        </tr>
                        <tr>
                            <td class="subcategory_table_autopats" colspan="4">{$branchName}</td>
                        </tr>

                        {foreach $result as $item}
                            <tr>
                                <td class="table_autopats_brand">{$item['brand']}</td>
                                <td class="table_autopats_art">{$item['art_number']}</td>
                                <td class="table_autopats_specs">{$item['name']}</td>
                                <td class="table_autopats_more"><a href="{$item['url']}"><img src="img/more_btn.png"></a></td>
                            </tr>
                        {/foreach}
                    </table>
                {else}
                    <div class='noresult'>
                        <div class="subcategory_table_autopats">
                            К сожелению, запчасти по выбраным Вами критериям сейчас отсутсвуют.
                        </div>
                        <div class="btn_back"><a href="index.php?mfr=AC"><img src="img/back_btn.jpg"></a></div>
                    </div>

                {/if}

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
    </body>
</html>