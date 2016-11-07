<?php
namespace app\models;

use Yii;

class UrlLink extends \yii\db\ActiveRecord
{
	private $timestamp;
	
    public static function tableName()
    {
        return 'url_link';
    }

    public function rules()
    {
        return [
            [['page_url', 'link_name', 'link_url', 'time'], 'required'],
            [['page_url', 'link_name', 'link_url'], 'string'],
            [['time'], 'integer']
        ];
    }
	
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_url' => 'Page Url',
            'link_name' => 'Link Name',
            'link_url' => 'Link Url',
            'time' => 'Time',
        ];
    }
	
	public function afterFind() {
		$this->time = date("d.m.Y H:i:s", $this->time);
	}
	
	// Получаем текущую дату 
	public function getTimestamp(){
		return $this->timestamp = time();
	}
	
	// Сохраняем данные
	public function saveData($links, $page){
		$arrLinks = [];
		$time = $this->getTimestamp();
		foreach($links as $link){
			$arrLinks[] = array($page, $link["text"], $link["url"], $time);
		}
		\Yii::$app->db->createCommand()->batchInsert('url_link', ['page_url', 'link_name', 'link_url', 'time'],
            $arrLinks)
            ->execute();
	}
}
