<?php

namespace PEDevs;

use pocketmine\plugin\PluginBase;
use pocketmine\{Player, Server};
use pocketmine\item\Item;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\level\Position;
use pocketmine\math\Vector3;
use pocketmine\level\Level;

class MainBase extends PluginBase{
	
	public function onEnable(){
		$this->getLogger()->info(TextFormat::GOLD. "Plugin Active");
		 
		 @mkdir($this->getDataFolder());
	}
	
	public function onCommand(CommandSender $g, Command $kmt, string $label, array $args): bool{
		
		if($kmt->getName() == "heal" || $kmt->getName() == "can"){
			if($g->hasPermission() == "heal.command"){
			if(!empty($args[0])){
			$g = $sender->getPlayer();
			$g->setHealth(20);
			$g->sendMessage("§6» §bYou Healed");
			}elseif(empty($args[0])){
			if($oyuncu == $this->getServer()->isPlayer($args[0])){
				$oyuncu->sendMessage("§6»§b $g->getName() You Healled");
				$oyuncu->setHealth(20);
				$g->sendMessage("$oyuncu->getName() has been Healthed");
			}
			}
		}
	}
		if($kmt->getName() == "feed" || $kmt->getName() == "beslen"){
			if($g->hasPermission() == "feed.command")
						if(!empty($args[0])){
			$g->setFood(20);
			$g->sendMessage("§6» §bYou Healed");
			}elseif(empty($args[0])){
			if($oyuncu == $this->getServer()->isPlayer($args[0])){
				$oyuncu->sendMessage("§6»§b $g->getName() You Healled");
				$oyuncu->setFood(20);
				$g->sendMessage("$oyuncu->getName() has been Healthed");
			}
			}
			}
		
		if($kmt->getName() == "fly" || $kmt->getName() == "uc"){
			$isim = $g->getName();
							$cfg = new Config($this->getDataFolder() . "Players/$isim", Config::YAML);
						if($g->hasPermission() == "fly.command"){
						if(!empty($args[0])){
		   if($cfg->get("fly-mode") == "false"){
				$g->setAllowFlight(true);
			$g->sendMessage("§6» §bFly Mode Active");
			}else{
								$g->setAllowFlight(true);
			$g->sendMessage("§6» §bFly Mode De-Active");
			}
			}else{
				$g->sendMessage("§4Ussage: /fly");
			}
			}
		}
		
		if($kmt->getName() == "repair" || $kmt->getName() == "tamir"){
			if($kmt->hasPermission("repair.command")){
				
				$item = $g->getItem();
				$item->setDamage(0);
				$g->sendMessage("§6» §bRepair Complate");
			}
		}
		if($kmt->getName() == "warn" || $kmt->getName() == "uyar"){
	
			if($g->hasPermission() == "warn.command"){
				if(!empty($args[0]) && !empty($args[1])){
					if(is_numeric($args[1])){
						if($oyuncu = $this->getServer()->isPlayer($args[0])){
								$isim = $oyuncu->getName();
											$cfg = new Config($this->getDataFolder() . "Players/$isim", Config::YAML);
									$warns = $cfg->get("warnpoints");
							if($warns <= 9){
					
													$cfg->set("lastwarnreason", $args[2]);
				$cfg->set("lastwarn", $args[1]);
				$cfg->set("warnpoints", $cfg->get("warnpoints") + $args[1]);
				$warnnn = $cfg->get("warnpoints");
		 $this->getServer()->broadcastMessage("§e".$oyuncu." §cWarned By §e".$g->getName()." §cPoint:§e".$args[1]." §cReason §e".$args[2]." §cAll Points: §e".$warnpoints);
				
				
				}elseif($warns >= 10){
									$cfg->set("lastwarn", $args[1]);
				$cfg->set("warnpoints", $cfg->get("warnpoints") + $args[1]);
				          	$this->getServer()->dispatchCommand(new ConsoleCommandSender, "ban ". $oyuncu->getName(). "§4".$args[2]."\n§4Admin: §b".$g->getName());
	}
				}
				
				}else{
					$g->sendMessage(TextFormat::RED. "Ussage: /warn <player> <point> <reason>");
				} 				//is_numeric

				}else{
										$g->sendMessage(TextFormat::RED. "Ussage: /warn <player> <point> <reason>"); 
				} //empty
				
			}
		}
		if($kmt->getName() == "spawn" || $kmt->getName() == "lobi"){
			$g->teleport($this->getServer()->getDefaultLevel()->getSpawnLocation(), $this->getServer()->getDefaultLevel());
		}
		if($kmt->getName() == "gmc"){
			$g->setGameMode(1);
			$g->sendMessage("§6» Your Gamemode Creative");
		}
				if($kmt->getName() == "gms"){
			$g->setGameMode(0);
			$g->sendMessage("§6» Your Gamemode Survival");
		}
				if($kmt->getName() == "gma"){
			$g->setGameMode(3);
			$g->sendMessage("§6» Your Gamemode Adventure");
		}
		return true;
		
	}
}
?>