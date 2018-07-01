<?php

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\math\Vector3;

class Spawn extends Command{

    /** @var BaseAPI */
    private $plugin;

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("spawn", "Spawn command!");
        $this->setPermission("essentials.spawn.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            $sender->sendMessage(TextFormat::GREEN . "Teleporting spawn...");
            $sender->teleport($this->plugin->getServer()->getDefaultLevel()->getSpawnLocation(), $this->plugin->getServer()->getDefaultLevel());
        }else{
            $sender->sendMessage(TextFormat::RED . "Please use this command in game.");
        }
    }
}
