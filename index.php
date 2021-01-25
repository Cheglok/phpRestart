<?php

define('TEMPLATES_DIR', './templates/');
define('LAYOUTS_DIR', 'layouts/');

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = "index";
}

$links = [
    [
        "title" => "Главная",
        "link" => "/"
    ],
    [
        "header" => "Путешествия",
        "sublist" => [
            [
                "title" => "Шри-Ланка",
                "link" => "/"
            ],
            [
                "title" => "Португалия",
                "link" => "/"
            ],
            [
                "header" => "Турция",
                "sublist" => [
                    [
                        "title" => "Турция 2017",
                        "link" => "/"
                    ],
                    [
                        "title" => "Турция 2019",
                        "link" => "/"
                    ]
                ]
            ],
            [
                "title" => "Израиль",
                "link" => "/"
            ],
            [
                "title" => "Тайланд",
                "link" => "/"
            ]
        ]
    ],
    ["title" => "Все Путешествия", "link" => "/?page=catalog"],
    ["title" => "Фронтенд версия", "link" => "/frontend"]
];

function makeMenu($links)
{
    foreach ($links as $key => $value) {
        echo "<ul>";
        if ($value["sublist"]) {
            echo $value["header"];
            makeMenu($value["sublist"]);
        } else {
            echo
                "<li><a href=" . $value["link"] . ">" . $value["title"] . "</a></li>";
        }
        echo "</ul>";
    }
}

$params = ['login' => 'admin', 'links' => $links];
switch ($page) {
    case "index":
        $params["name"] = "Миша Чеглок";
        break;
    case "catalog":
        $params["catalog"] = [
            [
                "country" => "Шри-Ланка",
                "year" => 2017
            ],
            [
                "country" => "Португалия",
                "year" => 2018
            ],
            [
                "country" => "Тайланд",
                "year" => 2019
            ],
        ];
        break;
    case "apicatalog":
        $params["catalog"] = [
            [
                "name" => "Пицца",
                "price" => 80
            ],
            [
                "name" => "Чай",
                "price" => 40
            ],
            [
                "name" => "Куриное бедро",
                "price" => 50
            ],
        ];
        echo json_encode($params, JSON_UNESCAPED_UNICODE);
        exit;
        break;
}

echo render($page, $params);

function render($page, $params = [])
{
    return renderTemplate(LAYOUTS_DIR . 'main', [
        'content' => renderTemplate($page, $params),
        'menu' => renderTemplate('menu', $params)
    ]);
}

function renderTemplate($page, $params = [])
{
    ob_start();


    if (!is_null($params))
        extract($params);
    $filename = TEMPLATES_DIR . "{$page}.php";
    if (file_exists($filename)) {
        include $filename;
    } else {
        die("Такой страницы не существует. 404");
    }

    return ob_get_clean();
}

