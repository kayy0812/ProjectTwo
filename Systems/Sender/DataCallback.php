<?php

namespace Systems\Sender;

class DataCallback
{

	private static $categories;
	private static $tabs;
    /**
     * Get Settings From Database
     * @param string $name
     */
    public static function Category($direction, $name)
    {
        global $database;
        $database->SetQuery("SELECT * FROM categories");
        if (empty(self::$categories)) {
            foreach ($database->fetch_assoc() as $category) {
            	if ($direction == 'var-to-value') {
            		self::$categories[$category['var']] = $category['value'];
            	} elseif ($direction == 'value-to-var') {
            		self::$categories[$category['value']] = $category['var'];
            	}
            }
        }
        return self::$categories[$name] ?: false;
    }

    public static function ListCategory() 
    {
    	global $database;
        $database->SetQuery("SELECT * FROM categories");
        if (empty(self::$categories)) {
            foreach ($database->fetch_assoc() as $category) {
            	self::$tabs .= '';
            }
        }

        return self::$tabs?: false;
    }

	/**
	 * cURL
	 * @param string $id
	 */
	public static function cURL($url)
	{
		$data = curl_init();
        curl_setopt_array($data, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $json_string = curl_exec($data);
        curl_close($data);
        return $json_string;
	}
}
