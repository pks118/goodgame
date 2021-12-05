@extends('layouts.main-layout')
@section('title', 'За Чистые Выборы')
@section('content')
<!-- Banner -->
<section id="banner">
    <div class="inner">
        <h2 id="title_header">КАРТА СООБЩЕНИЙ</h2>
    </div>
    <div id="map" style="padding: 0 20% 0 20%; margin: 0 0 3% 0; width: 100%; height:100%"></div>
    <ul class="actions special">
        @hasallroles('admin|user')
            <li><a href="/add_message" class="button">Отправить сообщение</a></li>
        @endhasallroles
        @guest
            <button disabled = "disabled">Отправить сообщение</button>
            <center><label>Отправлять сообщения могут только зарегистрированные пользователи</label></center>
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="button" href="{{ route('login') }}">{{ __('Войти') }}</a>
                </li>
            @endif
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="button" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                </li>
            @endif
        @endguest

    </ul>
</section>

<!-- One -->
<section id="one" class="wrapper style_title special">
    <h2 id="news_index">Новости</h2>
</section>



<!-- Two -->
<section id="two" class="wrapper alt style2">

    @foreach($news as $new)
    <section class="spotlight">
        <div class="image">
            <img src="/uploads/{{json_decode($new->image)[0]}}" alt="error404" /></div><div class="content">
            <h2>{{$new->title}}</h2>
            <p>{{$new->description}}</p>
            <ul class="actions special">
                <li><a  class="button" href="/tidinggen/{{$new->id}}">Подробнее</a></li>
            </ul>
        </div>
    </section>
    @endforeach
<div>
    <nav aria-label="Page navigation example">
    {{$news->links("pagination::bootstrap-4")}}
    </nav>
</div>




</section>


<!-- Map Script -->
<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>

<?php
    $addresses = [];
    foreach ($list as $row){
        $addresses[] = [
            'title' => $row->title,
            'description' => $row->description,
            'status' => $row->status
        ];
    }
    $addresses = json_encode($addresses);
?>

<script type="text/javascript">
    ymaps.ready(init);
    function init() {
        var myMap = new ymaps.Map("map", {
            center: [<?php echo $list[0]['koordinat']; ?>],
            zoom: 16,
            controls: ['zoomControl', 'typeSelector',  'fullscreenControl']
        }, {
            searchControlProvider: 'yandex#search'
        });
        clusterer = new ymaps.Clusterer({
            /**
             * Через кластеризатор можно указать только стили кластеров,
             * стили для меток нужно назначать каждой метке отдельно.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
             */
            preset: 'islands#invertedBlueClusterIcons',
            /**
             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
             */
            groupByCoordinates: false,
            /**
             * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
             */
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false,
            clusterBalloonContentLayoutWidth: 580,
            clusterBalloonContentLayoutHeight: 340,
            geoObjectBalloonContentLayoutWidth: 580,
            geoObjectBalloonContentLayoutHeight: 320
        }),
            /**
             * Функция возвращает объект, содержащий данные метки.
             * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
             * Поле balloonContentBody - источник данных для контента балуна.
             * Оба поля поддерживают HTML-разметку.
             * Список полей данных, которые используют стандартные макеты содержимого иконки метки
             * и балуна геообъектов, можно посмотреть в документации.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
             */
            getPointData = function (index, address, desc, st) {
                return {
                    balloonContentHeader: address !== null ? 'Ул.' + address : '',
                    balloonContentBody: desc !== null ? desc : '',
                    balloonContentFooter: '<img class="imgmap" src = "img/doki_doki.jpg" alt = "error" / > <br> Статус:' + st,
                    clusterCaption: address !== null ? 'Ул.' + address : '',

                };
            },
            /**
             * Функция возвращает объект, содержащий опции метки.
             * Все опции, которые поддерживают геообъекты, можно посмотреть в документации.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
             */
            getPointOptions = function () {
                return {
                    preset: 'islands#blueIcon'
                };
            },
            points = [
                    <?php foreach ($list as $row): ?>
                [<?php echo $row['koordinat']; ?>],
                <?php endforeach; ?>
            ],
            geoObjects = [];

        /**
         * Данные передаются вторым параметром в конструктор метки, опции - третьим.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
         */
        let addresses = <?=$addresses?>;
        let description = <?=$addresses?>;
        let status = <?=$addresses?>;
        for(var i = 0, len = points.length; i < len; i++) {
            let address = null;
            let desc = null;
            let st = null;
            if(addresses.length > i){
                address = addresses[i].title;
                desc = description[i].description;
                st = status[i].status;

            }
            geoObjects[i] = new ymaps.Placemark(points[i], getPointData(i, address, desc, st), getPointOptions());
        }

        /**
         * Можно менять опции кластеризатора после создания.
         */
        clusterer.options.set({
            gridSize: 80,
            clusterDisableClickZoom: true
        });
        var volgograd = ymaps.geoQuery(ymaps.regions.load("RU", {
            lang: "ru"
        })).search('properties.hintContent = "Волгоградская область"').setOptions({
            fillOpacity: '0.4',
            fillColor: '#7184C286',
            strokeColor: '#fa4d09'
        });
        var myCollection = new ymaps.GeoObjectCollection();
        volgograd.addToMap(myMap);
        myMap.geoObjects.add(myCollection);

        /**
         * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
         */
        clusterer.add(geoObjects);
       myMap.geoObjects.add(clusterer);

        /**
         * Спозиционируем карту так, чтобы на ней были видны все объекты.
         */

        myMap.setBounds(clusterer.getBounds(), {
            checkZoomRange: true
        });

        // Сделаем у карты автомасштаб чтобы были видны все метки.
        myMap.setBounds(myCollection.getBounds(),{checkZoomRange:true, zoomMargin:9});
    }

</script>

</body>
</html>
