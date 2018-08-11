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
        if(empty($args[0])) {
            switch($sender->getAllowFlight()) {
                    case true;
                      $sender->setAllowFlight(false);
                      $sender->sendMessage(TextFormat::GREEN."Fly has been enabled.");
                    break;
                    case false;
                       $sender->setAllowFlight(true);
                       $sender->sendMessage(TextFormat::RED."Fly has been disabled.");
                    break; 
            }
            
        }else{
            if($sender->hasPermission("fly.other")) {
                $player = Server::getInstance()->getPlayer($args[0]);
                if($player instanceof Player) {
                    switch($player->getAllowFlight()) {
                            case true;
                              $player->setAllowFlight(false);
                              $player->sendMessage(TextFormat::GREEN."Fly has been enabled.");
                            break;
                            case false;
                               $player->setAllowFlight(true);
                               $player->sendMessage(TextFormat::RED."Fly has been disabled.");
                            break;
                    }
                }else{
                    $player->sendMessage(TextFormat::RED."Player not online.");
                }
            }else{
                $player->sendMessage(TextFormat::RED."You dont have permission to fly other players.");
            }
        }
        return true;
    }
}
