<?php

namespace PEDevs\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Repair extends Command{

    public function __construct(){
        parent::__construct("repair", "Repair command!");
        $this->setPermission("essentials.repair.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(!$this->testPermission($sender)) return false;

        if($sender instanceof Player){
            $item = $sender->getInventory()->getItemInHand();
            if($item->getId() !== 0){
                $item->setDamage(0);
                $sender->getInventory()->setItemInHand($item);
                $sender->sendMessage(TextFormat::GREEN . "Repaired!");
            }else{
                $sender->sendMessage(TextFormat::RED . "You can not repair the air!");
            }
        }else{
            $sender->sendMessage(TextFormat::RED . "Please use this command in game.");
        }
        return true;
    }
}