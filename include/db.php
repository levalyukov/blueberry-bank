<?php
    // error_reporting(0);

    $db_server   = 'localhost';
    $db_name     = 'bank';
    $db_user     = 'root';
    $db_password = '';
    $db_error    = '';

    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        $db_error = $conn->connect_error;
    }

    function create_securities() : void
    {
        global $conn;
        if (!$conn->query("CREATE TABLE `securities` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `symbol` VARCHAR(12) NOT NULL,
            `name` TEXT NOT NULL,
            `volatility` DECIMAL(5,2) NOT NULL DEFAULT 0.5,
            `price` DECIMAL(10,2) NOT NULL DEFAULT 100.00,
            `type` ENUM('stocks','bonds','currency','metals') DEFAULT 'stocks',
            `image` TEXT NOT NULL,
            `coupon_rate` DECIMAL(5,2) NULL,
            `maturity_date` DATE NULL,
            `face_value` DECIMAL(10,2) DEFAULT 1000.00
        )")) {
            $db_error = "Ошибка создания базы данных для ценных бумаг.";
        } else {
            init_portfolio();
            init_stocks();
            init_bonds();
            init_currency();
            init_metals();
        }
    }

    function init_portfolio() : void
    {
        global $conn;

        $conn->query("CREATE TABLE `portfolio` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `securities_id` INT NOT NULL,
            `new_price` DECIMAL(10,2) NOT NULL,
            `old_price` DECIMAL(10,2) NOT NULL,
            `amount` INT NOT NULL,
            `type` ENUM('stocks','bonds','currency','metals') DEFAULT 'stocks'
        )");
    }

    function init_stocks() : void 
    {
        global $conn;

        // Banks
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('SBER', 'Сбербанк', 20.50, 350.00, 'https://s3-symbol-logo.tradingview.com/sberbank--600.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('MBNK', 'МТС Банк', 14.35, 1300, 'https://cdn.ruplay.market/data/images/e5ac7d0d-5f2a-4d95-a144-e0280a4c8b1c')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('T', 'Т-Технологии', 17.52, 3190.00, 'https://s3-symbol-logo.tradingview.com/tcs-group-holding--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('VTBR', 'ВТБ', 10.43, 90.00, 'https://s3-symbol-logo.tradingview.com/vtbr--big.svg')");

        // Extractive natural resources
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('LKOH', 'ЛУКОЙЛ', 2.69, 5400.58, 'https://s3-symbol-logo.tradingview.com/lukoil--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('ROSN', 'Роснефть', 12.19, 460.23, 'https://s3-symbol-logo.tradingview.com/rosneft--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('GAZP', 'Газпром', 13.52, 90.81, 'https://s3-symbol-logo.tradingview.com/gazprom--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('TATN', 'Татнефть', 10.32, 620.41, 'https://s3-symbol-logo.tradingview.com/tatneft--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('NVTK', 'НОВАТЭК', 10, 1281.42, 'https://s3-symbol-logo.tradingview.com/novatek--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('PLZL', 'Полюс', 10, 2271, 'https://s3-symbol-logo.tradingview.com/polyus--big.svg')");

        // IT / big-tech
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('OZON', 'Озон', 5.89, 4231.21, 'https://logo-teka.com/wp-content/uploads/2025/06/ozon-icon-logo.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('YDEX', 'Яндекс', 3.84, 4221.12, 'https://platforms.su/storage/product-logo/1755356939_0OOA8Yq7QF.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('VKCO', 'ВК', 53.23, 270.02, 'https://s3-symbol-logo.tradingview.com/mail-ru-group--big.svg')");

        // Supermarkets
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('MGNT', 'Магнит', 10, 3000.52, 'https://s3-symbol-logo.tradingview.com/magnit--big.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, image) 
        VALUES ('LENT', 'Лента', 10, 2000.67, 'https://s3-symbol-logo.tradingview.com/lenta--big.svg')");
    }
    function init_bonds() : void 
    {
        global $conn;

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image, coupon_rate, face_value) 
        VALUES ('RU000A1038V6', 'ОФЗ 26238', 2.15, 675.50, 'bonds', '
        https://aic.ru/img/1c2b55ff-645e-45fa-b7cf-b55400e19410/gerbpic2.png?fm=jpg&q=80&fit=max&crop=1408%2C1400%2C0%2C0', 7.10 ,1000.00)");
    }
    function init_currency() : void 
    {
        global $conn;

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('CNY', 'Китайский юань', 13.12, 32.72, 'currency', 'assets/flags/CN.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('USD', 'Американский Доллар', 13.12, 52.72, 'currency', 'assets/flags/US.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('EUR', 'Евро', 13.12, 52.72, 'currency', 'assets/flags/EU.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('UAH ', 'Украинская гривна', 13.12, 0.17, 'currency', 'assets/flags/UA.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('KRW', 'Южнокорейская вона', 13.12, 22.72, 'currency', 'assets/flags/KR.svg')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('PLN', 'Польский злотый', 13.12, 20.72, 'currency', 'assets/flags/PL.svg')");
    }
    function init_metals() : void 
    {
        global $conn;

        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('Au', 'Золото', 13.12, 11512.72, 'metals', 'https://alfaonline.servicecdn.ru/public/s3/static/investment/img_gold_bar.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('Ag', 'Серебро', 13.12, 5703.65, 'metals', 'https://alfaonline.servicecdn.ru/public/s3/static/investment/img_silver_bar.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('Pl', 'Платина', 13.12, 4835.85, 'metals', 'https://alfaonline.servicecdn.ru/public/s3/static/investment/img_platinum_bar.png')");
        $conn->query("INSERT INTO securities (symbol, name, volatility, price, type, image) 
        VALUES ('U', 'Уран', 13.12, 378655.72, 'metals', 'https://t3.gstatic.com/licensed-image?q=tbn:ANd9GcQNHnFrL7AuYZFVdYD5upBht_pNxnd6s141Br09iFkIGUi5IBe9K1DP-p0kk3qMY95pmK4eyT-d9EWy2X3p')");
    }
?>