<?php
namespace Systems;

use Systems\Data;

Class Assets
{
    private $cache        = true;
    private $active       = "dashboard";
    private $class        = "fullscreen-bg";
    private $charset      = "utf-8";
    private $viewport     = "width=device-width, initial-scale=1, shrink-to-fit=no";
    private $title        = "Xem phim online";
    private $prefix       = " - YEUFREE.CF";
    private $stylesheets  = [];
    private $javascripts  = [];
    private $script       = null;

    /**
     * Generate `<head>` element
     */
    public function GetHeader()
    {
        $head[] = '<!doctype html>';
        $head[] = '<html lang="en" class="' . $this->class . '">';
        $head[] = '<head>';
        $head[] = '<meta charset="' . $this->charset . '">';
        $head[] = '<meta name="viewport" content="' . $this->viewport . '">';
        $head[] = $this->GetTitle();
        $head[] = '<link rel="icon" type="image/x-icon" href="/Templates/Images/juicycodes.ico">';
        $head[] = $this->GetStylesheet();
        $head[] = '</head>';
        $head[] = '<body>';

        echo implode("\n", $head);
    }
    /**
     * Add stylesheet(s)
     * @param string|array $value
     */
    public function AddStylesheet($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                $this->stylesheets[] = $val;
            }
        } else {
            $this->stylesheets[] = $value;
        }
        return $this;
    }

    /**
     * Print Stylesheets
     */
    private function GetStylesheet()
    {
    	$css = [];
    	foreach ($this->stylesheets as $style) {
    		$css[] = '<link rel="stylesheet" href="' . $style . '?changing-md5="'.md5(rand()).'>';
    	}
    	return implode("\n", $css);
    }

    /**
     * Add javascript(s)
     * @param string|array $value
     */
    public function AddJavascript($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                $this->javascripts[] = $val;
            }
        } else {
            $this->javascripts[] = $value;
        }
        return $this;
    }

    /**
     * Print Stylesheets
     */
    private function GetJavascript()
    {
    	$js = [];
    	foreach ($this->javascripts as $javascript) {
    		$js[] = '<script src="' . $javascript . '?changing-md5="'.md5(rand()).'"></script>';
    	}
    	return implode("\n", $js);
    }

    /**
     * Redirect a page to given URL
     * @param strinf  $url
     * @param boolean $exit
     */
    public function Redirect($url, $exit = false)
    {
        header("Location: $url");
        if ($exit) {
            exit;
        }
        return $this;
    }

    /**
     * Redirect page to referer
     * @param boolean $exit
     */
    public function GoBack($exit = false)
    {
        return $this->Redirect($_SERVER["HTTP_REFERER"], $exit);
    }

    /**
     * End a HTML page
     */
    public function GetFooter()
    {
        //$this->Alerts();
        if ($this->javascripts != []) {
            $head[] = $this->GetJavascript();
        }
        if ($this->script != null) {
            $head[] = $this->GetScript();
        }
        $head[] = '</body>';
        $head[] = '</html>';

        echo implode("\n", $head);
    }

    /**
     * Script 
     */
    public function AddScript($script)
    {
        $this->script = $script;
    }

    /**
     * Get Script
     */
    public function GetScript()
    {
        $script[] = '<script>';
        $script[] = $this->script;
        $script[] = '</script>';

        return implode(" ", $script);
    }

    private function GetTitle()
    {
        return '<title>' . $this->title . $this->prefix . '</title>';
    }

    /**
     *@param string $title 
     */
    public function SetTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     *@param string $prefix 
     */
    public function SetPrefix($prefix)
    {
        $this->prefix = ' - '.$prefix;
        return $this;
    }

    /**
     *@param string $viewport 
     */
    public function SetViewport($viewport)
    {
        $this->viewport = ' - '.$viewport;
        return $this;
    }

    /**
     *@param string $charset 
     */
    public function SetCharset($charset)
    {
        $this->charset = ' - '.$charset;
        return $this;
    }

}
