<?php
namespace Iridwil\DesignPatterns;

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "Моллакент ру, Моллакент, село Моллакент, сайт села Моллакент, Моллакент хуьр, Моллакент хюр, Mollakent");
$APPLICATION->SetTitle("Test");


class Singleton
{
    private static $instances = [];

    protected function __construct(){}

    protected function clone(){}

    public function __wakeup(){
        throw new \Exception("Cannot unserialize a singleton");
    }

    public static function getInstance(): Singleton
    {
        $cls = static::class;
        echo $cls;
        if(!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function someBusinessLogic()
    {

    }
}

function clientCode()
{
    $s1 = Singleton::getInstance();
    $s2 = Singleton::getInstance();

    if($s1 === $s2)
        echo "Синглтоны работают, обе переменные содержат один и тот же экземпляр";
    else
        echo "Ошибка, переменные содержат разные экземпляры";
}

clientCode();


class Config extends Singleton
{
    private $hashmap = [];

    public function getValue(string $key): string
    {
        return $this->hashmap[$key];
    }

    public function setValue(string $key, string $value): void
    {
        $this->hashmap[$key] = $value;
    }
}

$config1 = Config::getInstance();
$login = "test_login";
$password = "test_password";
$config1->setValue("login", $login);
$config1->setValue("password", $password);
// ...и восстанавливает их.
$config2 = Config::getInstance();
if ($login == $config2->getValue("login") &&
    $password == $config2->getValue("password")
) {
    echo "Config singleton also works fine.";
}
?>



<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>