<?php

namespace ClockMenu;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Level;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerDeathEvent;

class Main extends PluginBase implements Listener{
	
	public $config;
	
	public function onEnable(){
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§6Activated");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML,[
		"clock_name" => "Your Server Name",
		"first_item_name" => "Your Things",
		"second_item_name" => "Your things",
		"third_item_name" => "Your things",
		"fourth_item_name" => "Your Things",
		
		"second_item_teleport" => "your world name",
		"third_item_teleport" => "your world"
		
		]);
		}
		
		public function onJoin(PlayerJoinEvent $event){
			
			$player = $event->getPlayer();
			$player->getInventory()->clearAll();
			$item1 = Item::get(Item::CLOCK);
			$item1->setCustomName($this->config->get("clock_name"));
			$player->getInventory()->setItem(4, $item1);
		
	}
	
	public function onInteract(PlayerInteractEvent $event1){
		
		$player = $event1->getPlayer();
		$item = $player->getInventory()->getItemInHand();
		if($item->getCustomName() == this->config->get("clock_name")){
			$player->getInventory()->clearAll();
			//Things 1 
			$item2 = Item::get(Item::SLIMEBALL, 12,1);
			$item2->setCustomName($this->config->get("first_item_name"));
			$player->getInventory()->setItem(4,$item2);
			//Thinga 2
			$item3 = Item::get(Item::DIAMOND_SWORD, 11,1);
			$item3->setCustomName($this->config->get("second_item_name"));
			$player->getInventory()->setItem(5,$item3);
			//Things 3 
			$item4 = Item::get(Item::DIAMOND_PICKAXE, 10,1);
			$item4->setCustomName($this->config->get("third_item_name"));
			$player->getInventory()->setItem(3,$item4);
			//Things 4
			$item1 = Item::get(Item::STICK, 14,1);
			$item1->setCustomName($this->config->get("fourth_item_name"));
			$player->getInventory()->setItem(8,$item1);
			//Things 5
			$item5 = Item::get(Item::STICK,9,1);
			$item5->setCustomName($this->config->get("fourth_item_name"));
			$player->getInventory()->setItem(0,$item5);
			
}else if($item->getCustomName() == $this->config->get("fourth_item_name")){
	$player->getInventory()->clearAll();
	$item1 = Item::get(Item::CLOCK);
    $item1->setCustomName($this->config->get("clock_name"));
	$player->getInventory()->setItem(4, $item1);
	
}else if($item->getCustomName() == $this->config->get("second_item_name")){
$player->teleport($this->getServer()->getLevelByName("KitPvP")->getSafeSpawn());

}else if($item->getCustomName() == $this->config->get("third_item_name")){
$player->teleport($this->getServer()->getLevelByName("Prison")->getSafeSpawn());
        }
    }
	public function onRespawn(PlayerDeathEvent $event){
   
   $player = $event->getPlayer();
   $player->getInventory()->clearAll();
   $item1 = Item::get(Item::COMPASS);
   $item1->setCustomName($this->config->get("clock_name"));
   $player->getInventory()->setItem(4, $item1);
  
 }
 }
