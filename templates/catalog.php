<h2>Список путешествий</h2>
<div>
    <? foreach ($catalog as $item):?>
    <div>
        <?=$item["country"]?><br>
        Год: <?=$item["year"]?><br>
        <button>Читать</button>
        <hr>
    </div>
    <?endforeach;?>

</div>
