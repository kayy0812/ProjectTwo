<?php
namespace Systems;

class Data{

    private static $settings;
    /**
     * Get Settings From Database
     * @param string $name
     */
    public static function Get($name)
    {
        global $database;
        $database->SetQuery("SELECT * FROM settings");
        if (empty(self::$settings)) {
            foreach ($database->fetch_assoc() as $setting) {
                self::$settings[$setting['var']] = $setting['value'];
            }
        }
        return self::$settings[$name] ?: false;
    }

	/**
     * AaltoRouter
     * @param string  $base
     * @param string $url
     * @return string
     */
    
	public static function BasePath($base, $url = false, $path = false)
    {
        if (empty($path)) {
            $url   = $url ?: "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            $path  = parse_url($url, PHP_URL_PATH);
            $base  = basename($base);
            $paths = explode($base, $path);
            if (empty($paths["1"])) {
                $base = false;
            } else {
                $base = $paths["0"] . $base;
            }
            return $base;
        } else {
            return $path;
        }
    }

}
