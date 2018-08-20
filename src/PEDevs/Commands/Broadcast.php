<?php

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\{Command, CommandSender};
use pocketmine\utils\TextFormat;

class Broadcast extends Command{

    /** @var BaseAPI $plugin */
    private $plugin;
    
    /** @var string */
    const PREFIX = "§7[§eDUYURU§7] ";

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("duyur", "Duyuru Komutu!");
        $this->setPermission("essentials.broadcast.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool{
        if(!$this->testPermission($sender)) return false;

        if(empty($args[0])) {
            $sender->sendMessage(TextFormat::RED . "Kullanım: /duyur <mesaj>");
        }else{
            $message = implode(" ", $args);
            Server::getInstance()->broadcastMessage(self::BROADCAST . TextFormat::RESET . $message);
        }
    }
}