<?

global $MESS;
IncludeModuleLangFile(__FILE__);

class zolin_iadminer extends CModule
{
    const MODULE_ID = "zolin.iadminer";
    var $MODULE_ID = "zolin.iadminer";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function zolin_iadminer()
    {
        $arModuleVersion = [];

        include(dirname(__FILE__) . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = GetMessage("ZOLIN_IADMINER_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("ZOLIN_IADMINER_MODULE_DESC");

        $this->PARTNER_NAME = GetMessage("ZOLIN_IADMINER_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("ZOLIN_IADMINER_PARTNER_URI");
    }

    function InstallDB()
    {
        RegisterModule(self::MODULE_ID);

        return true;
    }

    function InstallFiles()
    {
        // копируем js-файлы, необходимые для работы модуля
        CopyDirFiles(
            __DIR__ . '/assets/scripts',
            \Bitrix\Main\Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID . '/',
            true,
            true
        );

        // копируем css-файлы, необходимые для работы модуля
        CopyDirFiles(
            __DIR__ . '/assets/styles',
            \Bitrix\Main\Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID . '/',
            true,
            true
        );


        CopyDirFiles(__DIR__ . '/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');
        CopyDirFiles(__DIR__ . '/themes', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes', true, true);

        return true;
    }

    function InstallPublic()
    {
        return true;
    }

    function InstallEvents()
    {
        CModule::IncludeModule(self::MODULE_ID);

        return true;
    }

    function UnInstallDB($arParams = [])
    {
        UnRegisterModule(self::MODULE_ID);

        return true;
    }

    function UnInstallFiles()
    {
        // удаляем js-файлы
        \Bitrix\Main\IO\Directory::deleteDirectory(
            \Bitrix\Main\Application::getDocumentRoot() . '/bitrix/js/' . $this->MODULE_ID
        );

        // удаляем css-файлы
        \Bitrix\Main\IO\Directory::deleteDirectory(
            \Bitrix\Main\Application::getDocumentRoot() . '/bitrix/css/' . $this->MODULE_ID
        );

        DeleteDirFiles(__DIR__ . '/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');
        DeleteDirFiles(__DIR__ . '/themes', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes');

        return true;
    }

    function UnInstallPublic()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function DoInstall()
    {
        global $APPLICATION, $step;
        $keyGoodFiles = $this->InstallFiles();
        $keyGoodDB = $this->InstallDB();
        $keyGoodEvents = $this->InstallEvents();
        $keyGoodPublic = $this->InstallPublic();
    }

    function DoUninstall()
    {
        global $APPLICATION, $step;
        $keyGoodFiles = $this->UnInstallFiles();
        $keyGoodEvents = $this->UnInstallEvents();
        $keyGoodDB = $this->UnInstallDB();
        $keyGoodPublic = $this->UnInstallPublic();
    }
}
