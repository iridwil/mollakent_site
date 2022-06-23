<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Lezgi translit");
?>

    <p style="margin-bottom: 5px; clear: both; margin-top: 45px; font-size: 20px;">
        Введите текст на кирилице:
    </p>
    <form method="post" action="rez.php" enctype="multipart/form-data">
        <label for="text"></label>
        <textarea style="width: 100%; height: 300px" class="onmainpage" type="text" name="text"></textarea>
        <input class="translit" type="reset" value="clear">
        <input class="translit" type="submit" value="Translit" name="submit">
        <p>
        </p>
    </form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>