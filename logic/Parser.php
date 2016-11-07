<?php

namespace app\logic;

use Yii;
use \yii\base\Object;

class Parser extends Object {
	
	private $links;
	private $dom;
	private $url;
	
	public function __construct($url) {
		$this->links = [];
		$this->dom = new \DOMDocument();
		$this->url = $url;
	}
	// Загружаем контент
	public function createDOM() {
		// Отключаем ошибки
		$internalErrors = libxml_use_internal_errors(true);
		// Загружаем в DOM контент страницы 
		$this->dom->loadHTMLFile($this->url); 
		$internalErrors = libxml_use_internal_errors(true);
		return $this->dom;
	}
	
	// Получить все ссылки страницы
	public function getAllLink() {
		$this->createDOM();
		// Получаем атрибуты ссылок и запсываем их в массив
		foreach($this->dom->getElementsByTagName('a') as $link) { 
			$this->links[] = array('url' => $link->getAttribute('href'), 'text' => $link->nodeValue); 
		} 
		return $this->links; 
	}
}