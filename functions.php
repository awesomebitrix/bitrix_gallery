<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
ini_set('max_execution_time',0);
class deltaGalery
{	
	///////////////////////////////
	function __construct() 
	{
        $this->dir = "upload/DeltaGalery/";
        $this->dir_site = $_SERVER["DOCUMENT_ROOT"]."/";
		$this->thumb = "thumb/";
		$this->ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp' , 'BMP');
	}

	////////////////////////////////
	function convUtf ($name)
	{
		return iconv("windows-1251", "UTF-8" ,$name);
	}
	
	////////////////////////////////
	function displayErrors()
	{
		$MSG["NO_FOUND_FILE"] ="Файл не найден";
		$MSG["NO_FOUND_DIR"] ="Папка не найдина";
		$MSG["INVALID_FORMAT"] ="Неизвестный формат";
		return $MSG;
	}
	
	///////////////////////////////
	function structurFile ($dir)
	{
		$dir_full = $this->dir_site . $dir;
		$get_dir = array_diff(scandir($dir_full), array('..', '.'));
		sort($get_dir);

		if (!file_exists($dir_full.$this->thumb)) 
		{
			mkdir($dir_full.$this->thumb, 0777);
		}
		
		foreach ($get_dir as $get_files)
		{		
			list($name) = explode('.', $get_files);		
			$ext_file = end(explode('.', $get_files));
			
			

		
			if (in_array($ext_file, $this->ext))
			{
				list($width, $height) = getimagesize($dir_full . $name . "." . $ext_file);				
				$path_img_orig  = "/". $dir . $this->convUtf ($name) . "." . $ext_file;
			
				if (file_exists($dir_full . $this->thumb . $name . "." . $ext_file))
				{
					$path_thumb = "/".$dir . $this->thumb . $this->convUtf ($name) . "." . $ext_file;
				}
				else
				{
					$path_thumb = $path_img_orig;
				}
				
				$list_file[] = array("DIR" => $dir_full, "NAME" => $name, "EXT" => $ext_file, "THUMB" =>$path_thumb , "LINK" => $path_img_orig, "WIDTH" => $width, "HEIGHT" => $height);
			}
			
		}
		return $list_file;
	}	
	
	///////////////////////////////
	function galeryCreate($path_in, $x_new, $y_new, $qa, $out) 
	{
		ini_set("memory_limit","256M");
		list($x, $y, $type) = getimagesize($path_in);
		
		switch($type) 
		{	
			case "1" : $img = @imagecreatefromgif($path_in); break;
			case "2" : $img = @imagecreatefromjpeg($path_in); break;
			case "3" : $img = @imagecreatefrompng($path_in); break;
			case "6" : $img = @imagecreatefromwbmp($path_in); break;
		}
		
		if (!$img)
		{	
			//////////если не тот формат то переменовываем
			rename($path_in, $path_in . "_");
			return true;
		}
		else
		{
			$factor = $x / $y;
			
			if ($x_new / $y_new > $factor) 
			{
				$x_new = $y_new * $factor;
			}
			else 
			{
				$y_new = $x_new / $factor;
			}
			
			$img_new_size = imagecreatetruecolor($x_new, $y_new);
			imagecopyresampled($img_new_size, $img, 0, 0, 0, 0, $x_new, $y_new, $x, $y);	
			imagejpeg($img_new_size, $out, $qa);			
		}
			
	}
	
	////////////////////////////////
	function Init($dir, $width = 300, $height = 200, $quality = 100, $zip = "Y", $tumb = "Y", $max_image_size = 1920)
	{
		foreach ($this->structurFile($dir) as $arFile)
		{	
			$file = $arFile["DIR"] . $arFile["NAME"] . "." . $arFile["EXT"];	
			$file_tumb = $arFile["DIR"] . $this->thumb . $arFile["NAME"] . "." . $arFile["EXT"];
			if ($zip == "Y" && ($arFile["WIDTH"] > $max_image_size || $arFile["HEIGHT"] > $max_image_size))
			{
				
				$this->galeryCreate($file, $max_image_size, $max_image_size, 95, $file);
			}
			
			if ($tumb == "Y")
			{
				
				if (!file_exists($file_tumb))
				{
					if (($width > $arFile["WIDTH"] || $height > $arFile["HEIGHT"] || $width > $max_image_size || $height > $max_image_size ))
					{
						if ($arFile["WIDTH"] < $width)
							$width = $arFile["WIDTH"];
						else
							$width = $width;
							
						if ($arFile["HEIGHT"] < $height)
							$height = $arFile["HEIGHT"];
						else
							$height = $height;
					}
					$this->galeryCreate($file, $width, $height, $quality, $file_tumb);
				}
			}
		}		
		return true;
	}
	
}

?>














