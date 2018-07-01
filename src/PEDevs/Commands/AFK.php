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
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class AFK extends Command{
	
	/**@var BaseAPI*/
	private $plugin;
	
	public function __construct(){
		$this->plugin = BaseAPI::getInstance();
		
		parent::__construct("afk", "Afk Command");
	}
	
	public function execute(CommandSender $sender, string $commandLabel array $args): bool{
		$sender->sendMessage(TextFormat::AQUA . "You are Now ".TextFormat::GREEN."AFK");
		$this->getServer()->broadcastMessage("§c$sender->getName() §bis §aNow §bAFK");
	}
}

?>
