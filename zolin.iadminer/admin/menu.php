<?

IncludeModuleLangFile(__FILE__);

if ($USER->IsAdmin()) {
    return [
        'parent_menu' => 'global_menu_services',
        'section'     => 'iadminer',
        'sort'        => 110,
        'url'         => 'iadminer.php?server=localhost',
        'text'        => GetMessage('ZOLIN_IADMINER_ADMIN_MENU_TEXT'),
        'title'       => GetMessage('ZOLIN_IADMINER_ADMIN_MENU_TITLE'),
        'icon'        => 'iadminer_menu_icon',
        'module_id'   => 'zolin.iadminer',
    ];
}

return false;
