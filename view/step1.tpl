
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="x-ua-compatible" content="IE=edge">


        <title>Каталог TecDoc</title>

        <link rel="stylesheet" href="css/step1.css">

    </head>
    <body>
        <div class="page js-page page_column-left-no">
            <div class="page__in js-page_in">
                <div class="page__body springs clear js-page__body js-springs js-module" data-module="SpringsContainer">
                    <div class="page__body__unit" name="">
                        <div class="page__body__unit__in">
                            <div class="page__body__unit__box clear">
                                <div class="page__body__head">
                                    <div class="page__body__head__box">

                                        <div class="bread">
                                            <h1 class="bread__curr">Поиск по производителю автомобиля</h1>
                                        </div>

                                    </div>
                                </div>

                                <div class="page__body__main">
                                    <div class="page__body__main__box" role="main">
                                        <!--OPEN:CATALOG-INDEX-->
                                        <div class="catalog">
                                            <div class="catalog-abc-wrap">
                                                <div class="box">
                                                    <div class="box__in">
                                                        <div class="box__in__content">
                                                            <div class="catalog-abc">
                                                                <table class="catalog-abc__table js-catalog_letters">
                                                                    <tbody>
                                                                        <tr>
                                                                            {foreach $result as $item}

                                                                                <td class="catalog-abc__td">
                                                                                    <div class="catalog-abc__td__box js-catalog_letter_box">
                                                                                        <div class="catalog-abc__pin js-catalog_letter">
                                                                                            {$item@key}
                                                                                        </div>
                                                                                        <div class="catalog-abc__dropdown">
                                                                                            <div class="tooltip tooltip_top tooltip_center js-catalog_letter_tooltip">
                                                                                                <div class="tooltip__in">
                                                                                                    <i class="tooltip__in__tail"></i>
                                                                                                    <div class="tooltip__in__box js-catalog_letter_box">
                                                                                                        {foreach $item as $value}
                                                                                                            <div class="catalog-abc__dropdown__item" style="/* background: orange; */">
                                                                                                                <a href="index.php?mfr={$value}" class="catalog-abc__dropdown__link">{$value}</a><br>
                                                                                                            </div>
                                                                                                        {/foreach}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            {/foreach}

                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script src="js/jquery.js" type="text/javascript"></script>
                                            <script src="js/step1.js" type="text/javascript"></script>
                                            <div class="catalog-firm">
                                                <div class="caption__text">Популярные производители:</div>
                                                <div class="tile-pin-list tile-pin-list_catalog">
                                                    <a href="index.php?mfr=HUYNDAI" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/hyundai.jpg" alt="Hyundai" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Hyundai</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=KIA" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/kia.jpg" alt="Kia" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Kia</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=LADA" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/lada.jpg" alt="Lada (ВАЗ)" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Lada (ВАЗ)</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=MITSUBISHI" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/mitsubishi.jpg" alt="Mitsubishi" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Mitsubishi</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=NISSAN" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/nissan.jpg" alt="Nissan" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Nissan</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=RENAULT" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/renault.jpg" alt="Renault" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Renault</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=SKODA" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/skoda.jpg" alt="Skoda" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Skoda</span>
                                                        </span>
                                                    </a>

                                                    <a href="index.php?mfr=VW" class="tile-pin">
                                                        <span class="tile-pin__box">
                                                            <img src="img/volkswagen.jpg" alt="Volkswagen" class="tile-pin__pic">
                                                            <span class="tile-pin__text">Volkswagen</span>
                                                        </span>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <!--CLOSE:CATALOG-INDEX-->
                                    </div>
                                </div>

                                <!--not changeble element"1,2,3"-->
                                <div style="float: left;
                                     position: relative;
                                     z-index: 4;
                                     width: 240px;
                                     margin-left: -240px;">
                                    <table style="border: 0;font: 'Segoe UI'; width: 320px;">
                                        <tbody><tr>
                                                <td><img src="img/1.png"></td>
                                                <td style="
                                                    background: #FFEEA7;    
                                                    width: 267px;
                                                    ">
                                                    <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 1</div>
                                                    <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите марку и модель своего автомобиля</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><img src="img/2.png"></td>
                                                <td style="
                                                    background: #FFDE46;
                                                    ">
                                                    <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 2</div>
                                                    <div style="font-size: 16px; padding: 10px 10px 0 10px;">Выберите тип запчасти из
                                                        каталога</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><img src="img/3.png"></td>
                                                <td style="
                                                    background: #FF9D00;
                                                    ">
                                                    <div style="font-size: 18px; font-weight: bold; padding-left: 10px;">ШАГ 3</div>
                                                    <div style="font-size: 16px; padding: 10px 10px 0 10px;">Получите запчасти и аналоги
                                                        для вашего автомобиля</div>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>




            </div>
        </div>


    </body>
</html>

