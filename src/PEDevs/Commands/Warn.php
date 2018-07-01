<?php

namespace PEDevs\Commands;

use PEDevs\BaseAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Warn extends Command{

    /** @var BaseAPI */
    private $plugin;

    public function __construct(){
        $this->plugin = BaseAPI::getInstance();

        parent::__construct("warn", "Warn command!");
        $this->setPermission("essentials.warn.commands");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if(count($args) < 2){
            $sender->sendMessage(TextFormat::RED . "Usage: /warn <player> <reason> <point>");
            return false;
        }

        $player = $this->plugin->getServer()->getPlayer(array_shift($args));
        if(!$player instanceof Player){
            $sender->sendMessage(TextFormat::RED . "Please enter a valid player.");
            return false;
        }

        $point = array_pop($args);
        if(!is_numeric($point)){
            $sender->sendMessage(TextFormat::RED . "Point must be numeric value.");
            return false;
        }

        $reason = implode(" ", $args);
        $this->plugin->setWarn($player->getName(), $reason, $point);
        $player->sendMessage(TextFormat::GREEN . "You got " . $point . " points because of " . $reason . ". Authorized: " . $sender->getName());
        $sender->sendMessage(TextFormat::GREEN . $player->getName() . " got " . $point . " points because of " . $reason . ".");
        $this->plugin->getServer()->broadcastMessage(TextFormat::GREEN . $player->getName() . " got " . $point . " points because of " . $reason . ". Authorized: " . $sender->getName());
        return true;
    }
}