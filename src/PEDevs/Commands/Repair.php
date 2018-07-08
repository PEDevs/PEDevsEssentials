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
            if(empty($args[0]) {
                $item = $sender->getInventory()->getItemInHand();
                if($item->getId() == 0) {
                    $sender->sendMessage(TextFormat::RED . "You can't repair your hand.");
                    
                }else{
                    $item->setDamage(0);
                    $sender->getInventory()->setItemInHand($item);
                    $sender->sendMessage(TextFormat::GREEN . "You successfully repaired your item.");
                    
                }
                
            }else{
                switch($args[0]) {
                       case "all":
                        foreach($sender->getInventory()->getContents() as $items) {
                            if($items->getId() == 0) {
                               $sender->sendMessage(TextFormat::RED . "You don't have any repairable item.");
                               
                            }else{
                                $items->setDamage(0);
                                $sender->getInventory()->sendContents();
                                $sender->sendMessage(TextFormat::GREEN . "You successfully repaired your all items.");
                                
                            }
                            
                        }
                        break;
                       default:
                        $sender->sendMessage(TextFormat::RED . "Missing args.");
                        break;
                       
                }
                
            }
        }else{
            $sender->sendMessage(TextFormat::RED . "Please use this command in game.");
        }
        return true;
    }
}
