<?php

/**
 * Autocomplete for keywords, tables and columns.
 * @author David Grudl
 * @license BSD
 */
class AdminerAutocomplete
{
    public $keywords = [
        'DELETE FROM',
        'DISTINCT',
        'EXPLAIN',
        'FROM',
        'GROUP BY',
        'HAVING',
        'INSERT INTO',
        'INNER JOIN',
        'IGNORE',
        'LIMIT',
        'LEFT JOIN',
        'NULL',
        'ORDER BY',
        'ON DUPLICATE KEY UPDATE',
        'SELECT',
        'UPDATE',
        'WHERE',
    ];


    public function head()
    {
        $suggests = [];
        foreach ($this->keywords as $keyword) {
            $suggests[] = "$keyword ";
        }
        foreach (array_keys(tables_list()) as $table) {
            $suggests[] = $table;
            foreach (fields($table) as $field => $foo) {
                $suggests[] = "$table.$field ";
            }
        } ?>
        <link rel="stylesheet" type="text/css" href="/bitrix/css/zolin.iadminer/adminer.css">
        <script<?php echo nonce(); ?> type="text/javascript" src="/bitrix/js/zolin.iadminer/jquery.min.js"></script>
        <script<?php echo nonce(); ?> type="text/javascript" src="/bitrix/js/zolin.iadminer/tabcomplete.js"></script>
        <style>.hint {
                color: #bdc3c7;
            }</style>
        <script<?php echo nonce(); ?> type="text/javascript">
            $(function() {
                $('.sqlarea').tabcomplete(<?php echo json_encode($suggests) ?>);
            });
        </script>
        <?php
    }
}
