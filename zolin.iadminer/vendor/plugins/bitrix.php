<?

class AdminerBitrix
{
    var $DBHost, $DBLogin, $DBName, $DBPassword, $url;

    function __construct($DBHost, $DBLogin, $DBName, $DBPassword, $url)
    {
        $_SESSION['pwds']['server'][$DBHost][$DBLogin] = $DBPassword;
        $_SESSION['db']['server'][$DBHost][$DBLogin][$DBName] = true;

        $this->DBHost = $DBHost;
        $this->DBLogin = $DBLogin;
        $this->DBName = $DBName;
        $this->DBPassword = $DBPassword;
        $this->url = $url;

        $this->css =

        $_GET['server'] = $DBHost;
        $_GET['username'] = $DBLogin;
        $_GET['password'] = $DBPassword;
        $_GET['db'] = $DBName;
    }

    function name()
    {
        return "<a href='" . $this->url . "' id='h1'>Bitrix</a><br /><small>adminer ver.</small>";
    }

    function credentials()
    {
        return [$this->DBHost, $this->DBLogin, $this->DBPassword];
    }

    function database()
    {
        return $this->DBName;
    }
}
