<?php

/*
*  ____   _____  ____                    
* |  _ \ | ____||  _ \   ___ __   __ ___ 
* | |_) ||  _|  | | | | / _ \\ \ / // __|
* |  __/ | |___ | |_| ||  __/ \ V / \__ \
* |_|    |_____||____/  \___|  \_/  |___/                                        
*/

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\{Command, CommandSender};
use pocketmine\{Player, Server};
use pocketmine\utils\TextFormat as TF;

class AFK extends Command{
	
	/** @var BaseAPI $plugin */
	private $plugin;
	
	public function __construct(){
		$this->plugin = BaseAPI::getInstance();
		
		parent::__construct("afk", "Afk komutu");
	}
	
	public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
		if($this->plugin->getAfkState($sender) === null || $this->plugin->getAfkState($sender) == "no-afk"){         
           $sender->sendMessage(TF::RED . "AFK Durumun " . TF::AQUA . "\"AFK\" " . TF::RED . "olarak ayarlandı");
           $sender->setNameTag(TF::RED . "AFK\n" . $sender->getNameTag());
           $this->plugin->setAfkState($sender, "afk");
     }else{
          $sender->sendMessage(TF::RED . "AFK Durumun " . TF::AQUA . "\"AFK Değil\" " . TF::RED . "olarak ayarlandı");
         $sender->setNameTag($sender->getDisplayName());
        $this->plugin->setAfkState($sender);
     }
	}
}