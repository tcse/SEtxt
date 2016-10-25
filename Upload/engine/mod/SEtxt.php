<?php
	defined("DATALIFEENGINE") || die("Hack");
	include ENGINE_DIR . "/mod/LibBrowser.php";

	if(!class_exists('SEtxt'))
	{
		class SEtxt
		{
			private static $instance;
			private $Browser, $Browser_Array, $Os_Array;
			
			private function __construct(){}
			private function __clone(){}
			private function __wakeup(){}
			
			public static function getSingleton()
			{
				if (!isset(self::$instance))
					self::$instance = new self();
				return self::$instance;
			}
			
			public function construct()
			{
				$this->Browser = new Browser();
				$this->Browser_Array = array(
					"opera" => "Opera",
					"opera_mini" => "Opera Mini",
					"WebTV" => "WebTV",
					"edge" => "Edge",
					"ie" => "Internet Explorer",
					"pie" => "Pocket Internet Explorer",
					"konqueror" => "Konqueror",
					"icab" => "iCab",
					"omniweb" => "OmniWeb",
					"firebird" => "Firebird",
					"firefox" => "Firefox",
					"iceweasel" => "Iceweasel",
					"shiretoko" => "Shiretoko",
					"mozilla" => "Mozilla",
					"amaya" => "Amaya",
					"lynx" => "Lynx",
					"safari" => "Safari",
					"iphone" => "iPhone",
					"ipod" => "iPod",
					"ipad" => "iPad",
					"chrome" => "Chrome",
					"android" => "Android",
					"google" => "GoogleBot",
					"yahoo" => "Yahoo! Slurp",
					"w3c" => "W3C Validator",
					"blackberry" => "BlackBerry",
					"icecat" => "IceCat",
					"nokia_60" => "Nokia S60 OSS Browser",
					"nokia" => "Nokia Browser",
					"msn" => "MSN Browser",
					"vivalidi" => "Vivalidi",
					"playstation" => "PlayStation",
					"yandex" => "Yandex",
				);
				$this->Os_Array = array(
					"windows" => "Windows",
					"windows_ce" => "Windows CE",
					"apple" => "Apple",
					"linux" => "Linux",
					"os2" => "OS/2",
					"beos" => "BeOS",
					"iphone" => "iPhone",
					"ipod" => "iPod",
					"ipad" => "iPad",
					"blackberry" => "BlackBerry",
					"nokia" => "Nokia",
					"free" => "FreeBSD",
					"open" => "OpenBSD",
					"net" => "NetBSD",
					"sun" => "SunOS",
					"solaris" => "OpenSolaris",
					"android" => "Android",
					"sony" => "Sony PlayStation",
				);
			}
			
			public function checkOut($match, $val)
			{
				if(count(explode(",", $match))>1)
				{
					$all_val = explode(",", $match);
					$get_data = array();
					foreach($all_val as $value)
						$get_data[] = ($val == "browser") ? $this->Browser_Array[trim($value)] : $this->Os_Array[trim($value)];
					
					return ($val == "browser") ? (in_array($this->Browser->getBrowser(), $get_data) ? true : false) : (in_array($this->Browser->getPlatform(), $get_data) ? true : false);
				}
				else
				{
					$match = trim($match);
					return ($val == "browser") ? ($this->Browser_Array[$match] == $this->Browser->getBrowser() ? true : false) : ($this->Os_Array[$match] == $this->Browser->getPlatform() ? true : false);
				}
			}
			
			public function checkMatch($matches)
			{
				$check_os = $flag_os = $flag_browser = false;
				if( preg_match( "#browser(-\w+)?=['\"](.+?)['\"]#i", $matches[1], $match_browser ) ) {
					if($match_browser[2])
					{
						$flag_browser = $this->checkOut($match_browser[2], "browser");
						if( preg_match( "#os(-\w+)?=['\"](.+?)['\"]#i", $matches[1], $match_os ) ) {
							if($match_os[2])
							{
								$check_os = true;
								$flag_os = $this->checkOut($match_os[2], "os");
							}
						}
						return
						($match_browser[1] == "-not" && !$match_os[1] && (!$flag_browser && !$check_os || !$flag_browser && $check_os && $flag_os)) ? $matches[2] :
							($match_browser[1] == "-not" && $match_os[1] == "-not" && (!$flag_browser && !$check_os || !$flag_browser && $check_os && !$flag_os) ? $matches[2] :
								(!$match_browser[1] && !$match_os[1] && ($flag_browser && !$check_os || $flag_browser && $check_os && $flag_os) ? $matches[2] :
									(!$match_browser[1] && $matches_os[1] == "-not" && ($flag_browser && !$check_os || $flag_browser && $check_os && !$flag_os) ? $matches[2] : false
									)
								)
							);
					}
				}
				elseif( preg_match( "#os(-\w+)?=['\"](.+?)['\"]#i", $matches[1], $match_os ) ) {
					$check_os = $flag_os = $flag_browser = false;
					if($match_os[2])
						$flag_os = $this->checkOut($match_os[2], "os");
					
					if($flag_os && !$match_os[1] || !$flag_os && $match_os[1] == "-not")
						return $matches[2];
				}
			}
		}
	}
