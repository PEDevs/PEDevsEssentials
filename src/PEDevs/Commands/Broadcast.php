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
    
    /** @var string */
    const BROADCAST = "§5[§dBroadcast§5]";

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("bd", "Broadcast Command!");
        $this->setPermission("essentials.broadcast.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(!$this->testPermission($sender)) return false;
        if(empty($args[0]) {
            $sender->sendMessage(TextFormat::RED . "Usage : /bd <message>");
        }else{
            $message = implode(" ", $args);
            Server::getInstance()->broadcastMessage(self::BROADCAST . "§f" . $message);
        }
    }
}
