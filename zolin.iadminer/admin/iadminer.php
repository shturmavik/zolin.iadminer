<?

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global CDatabase $DB */

global $USER;
global $APPLICATION;

if (!$USER->IsAdmin()) {
    $APPLICATION->AuthForm("");
}

IncludeModuleLangFile(__FILE__);

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

function adminer_object()
{
    include_once $_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/zolin.iadminer/vendor/plugins/plugin.php";

    foreach (glob($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/zolin.iadminer/vendor/plugins/*.php') as $filename) {
        include_once $filename;
    }

    include($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.php');
    /** @var string $DBHost */
    /** @var string $DBLogin */
    /** @var string $DBName */
    /** @var string $DBPassword */

    global $APPLICATION;

    $plugins = [
        new AdminerDumpZip(),
        new AdminerDumpBz2(),
        new AdminerDumpJson(),
        new AdminerDumpDate(),
        new AdminerDisableJush,
        new AdminerAutocomplete,
        new AdminerSaveMenuPos,
        new AdminerRemoteColor,
        new AdminerDumpPhpPrototype,
        new AdminerTablesFilter,
        new AdminerBitrix($DBHost, $DBLogin, $DBName, $DBPassword, $APPLICATION->GetCurDir()),
    ];

    return new AdminerPlugin($plugins);
}

include $_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/zolin.iadminer/vendor/adminer.php";
