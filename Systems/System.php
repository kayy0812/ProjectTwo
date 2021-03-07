<?php
namespace Systems;

Class System
{

	private static $strings     = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqratuvwxyz_-";
    private static $time_zone   = "UTC";

    /**
     * Set application startup settings
     */
    public static function Initialize()
    {
        self::StartSession();
        self::StartTimeZone();
    }

	/**
     * Tạo chuỗi ngâu nhiên
     */
    public static function Random()
    {
        $strings = str_split(self::$strings);
        $rand = null;
        foreach (range(1, 10) as $i) {
            $rand .= $strings[array_rand($strings)];
        }
        return $rand;
    }

    /**
     * Sets the default timezone
     * @param string $zone
     */
    public static function StartTimeZone($zone = false)
    {
        if ($zone) {
            self::$time_zone = $zone;
        }
        date_default_timezone_set(self::$time_zone);
    }

    /**
     * Start new or resume existing session
     * @param array $options
     */
    public static function StartSession($options = false)
    {
        if (is_array($options)) {
            self::$session_options = $options;
            session_start(self::$session_options);
        } else {
            session_start();
        }
    }
} 
