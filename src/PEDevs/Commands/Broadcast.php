<?php

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class Broadcast extends Command{

    /** @var BaseAPI */
    private $plugin;

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("bd", "Broadcast Command!");
        $this->setPermission("essentials.broadcast.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(!$this->testPermission($sender)) return false;
        
      $msg = implode(" ", $args);
       $prefix = §7[§bBroad§aCaster§7];
      $this->getServer()->broadcastMessage($prefix . " ". $msg);
  }
}
