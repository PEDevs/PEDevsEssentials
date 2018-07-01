<?php

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Fly extends Command{

    /** @var BaseAPI */
    private $plugin;

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("fly", "Fly command!");
        $this->setPermission("essentials.fly.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        if(!$this->testPermission($sender)) return false;

        if(empty($args[0])){
            if($sender instanceof Player){
                $sender->setAllowFlight(true);
                $sender->sendMessage(TextFormat::GREEN . "You have been flying!");
            }else{
                $sender->sendMessage(TextFormat::RED . "Please use this command in game.");
            }
        }else{
            $player = $this->plugin->getServer()->getPlayer($args[0]);
            if($player instanceof Player){
                $player->setAllowFlight(true);
                $player->sendMessage(TextFormat::GREEN . "You have been flying!");
                $sender->sendMessage(TextFormat::AQUA . $player->getName() . TextFormat::GREEN . " have been flying!");
            }else{
                $sender->sendMessage(TextFormat::RED . "Please enter a valid player.");
            }
        }
        return true;
    }
}