<?php
$content = file_get_contents('https://bootswatch.com/api/3.json');
if(json_decode($content) != null) {
	$bootswatch = json_decode($content);
	if(isset($bootswatch->themes)) {
		$current_dir  = 'bootswatch';
		if (!file_exists($current_dir)) {
			mkdir($current_dir, 0755, true);
		}
		if (file_exists($current_dir)) {
			foreach($bootswatch->themes as $theme) {
				$target_dir = $current_dir . '/' . strtolower($theme->name);
				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0755, true);
					exec("cd " . $target_dir . " && wget " . $theme->css);
					exec("cd " . $target_dir . " && wget " . $theme->cssMin);
				}
			}
		}
	}
}