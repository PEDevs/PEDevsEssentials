<?php
/*  _____  ____    _    
*  |_   _||  _ \  / \   
*    | |  | |_) |/ _ \  
*    | |  |  __// ___ \ 
*    |_|  |_|  /_/   \_\
 */
namespace PEDevs\Commands;

use PEDevs\BaseAPI;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\Player;

use pocketmine\utils\TextFormat;

class Tpa extends Command{

/** @var BaseAPI */

private $plugin;

public function __construct(){

$this->plugin = BaseAPI::getInstance();

parent::__construct("tpa", "Tpa command!");

$this->setPermission("essentials.tpa.commands");

}

public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{

if(!$this->testPermission($sender)) return false;

if(empty($args[0])){

$sender->sendMessage(TextFormat::RED."Oyuncu bulunamadı!");

}else{

$player = $this->plugin->getServer()->getPlayer($args[0]);

if($player instanceof Player){

$this->plugin->setInvite($sender,$player);

$player->sendMessage(TextFormat::YELLOW . $sender->getName() . TextFormat::GREEN . "size ışınlanma isteği gönderdi!\nKabul ekmek için /tpak\nKabul etmemek için /tpar");

$sender->sendMessage(TextFormat::AQUA . $player->getName() . TextFormat::GREEN . " oyuncusuna davet gönderildi!");

}else{

$sender->sendMessage(TextFormat::RED . "Please enter a valid player.");

}

}

return true;

}

}
