<?php

namespace app\logic;

use Yii;
use \yii\base\Object;

class Parser extends Object {
	
	// Получить все ссылки страницы
	public function getAllLink($url) {
		// Создаем DOMDocument
		$dom = new \DOMDocument();
		// Отключаем ошибки
		$internalErrors = libxml_use_internal_errors(true);
		// Загружаем в DOM контент страницы 
		$dom->loadHTMLFile($url); 
		$internalErrors = libxml_use_internal_errors(true);
		$links = []; 
		// Получаем атрибуты ссылок и запсываем их в массив
		foreach($dom->getElementsByTagName('a') as $link) { 
			$links[] = array('url' => $link->getAttribute('href'), 'text' => $link->nodeValue); 
		} 
		// Возвращаем ссылки
		return $links; 
	}
}