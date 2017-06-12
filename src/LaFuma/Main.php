<?php

namespace LaFuma;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\Level;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\inventory\Inventory;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\nbt\tags\IntArrayTag;
use pocketmine\plugin\PluginBase;
use pocketmine\tile\Chest;
use pocketmine\tile\Tile;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("\n§l§cPlugin attivato con successo!\nSeguimi su Telegram @LaFuma per news");
		}
		
		public function onJoin(PlayerJoinEvent $event){
			
			$player = $event->getPlayer();
			$player->getInventory()->clearAll();
			$item1 = Item::get(Item::CLOCK);
			$item1->setCustomName("§l§bSolarDinasty§r");
			$player->getInventory()->setItem(4, $item1);
		
	}
	public function sendChestInventory(Player $player){
		$nbt = new CompoundTag('', [
		new StringTag('id', Tile::CHEST),
                new IntTag('§l§bSolarDinasty§', 1),
                new IntTag('x', floor($player->x)),
                new IntTag('y', floor($player->y) - 4),
                new IntTag('z', floor($player->z))
        ]);
		
        $tile = Tile::createTile('Chest', $player->getLevel(), $nbt);
        $block = Block::get(Block::CHEST);
        $block->x = floor($tile->x);
        $block->y = floor($tile->y);
        $block->z = floor($tile->z);
        $block->level = $tile->getLevel();
        $block->level->sendBlocks([$player], [$block]);
        $inventory = $tile->getInventory();
	$player->getInventory()->clearAll();
	$test = Item::get(276, 0, 1);
        $test->setCustomName("test");
	$tile->getInventory()->setItem(0, $test);
	$player->addWindow($inventory);
	}
}
