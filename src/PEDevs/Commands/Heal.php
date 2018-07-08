<?php

namespace PEDevs\Commands;


use PEDevs\BaseAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Heal extends Command{

    /** @var BaseAPI */
    private $plugin;

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("heal", "Heal command!");
        $this->setPermission("essentials.heal.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(!$this->testPermission($sender)) return false;

        if(empty($args[0])){
            if($sender instanceof Player){
                $sender->setHealth(20);
                $sender->sendMessage(TextFormat::GREEN . "You have been healed!");
            }else{
                $sender->sendMessage(TextFormat::RED . "Please use this command in game.");
            }
        }else{
            $player = $this->plugin->getServer()->getPlayer($args[0]);
            if($sender->isOp()) {
                if($player instanceof Player){
                    $player->setHealth(20);
                    $player->sendMessage(TextFormat::GREEN . "You have been healed!");
                    $sender->sendMessage(TextFormat::AQUA . $player->getName() . TextFormat::GREEN . " have been healed!");
                }else{
                    $sender->sendMessage(TextFormat::RED . "Please enter a valid player.");
                }
            }else{
                $sender->sendMessage(TextFormat::RED . "You must be op.");
            }
        }
        return true;
    }
}
