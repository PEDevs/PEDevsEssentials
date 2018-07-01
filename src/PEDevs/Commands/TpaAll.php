<?php
/*
*  _____  ____    _        _     _      _     
* |_   _||  _ \  / \      / \   | |    | |    
*   | |  | |_) |/ _ \    / _ \  | |    | |    
*   | |  |  __// ___ \  / ___ \ | |___ | |___ 
*   |_|  |_|  /_/   \_\/_/   \_\|_____||_____|                         
*/                            
namespace PEDevs\Commands;

use PEDevs\BaseAPI;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\Player;

use pocketmine\utils\TextFormat;

class TpaAll extends Command{

    /** @var BaseAPI */

    private $plugin;

    public function __construct(){

    $this->plugin = BaseAPI::getInstance();

    parent::__construct("tpaall", "TpaAll command!");

    $this->setPermission("essentials.tpaall.commands");

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{

      if(!$this->testPermission($sender)) return false;

        if(!empty($args[0])){

            $sender->sendMessage(TextFormat::RED."Use: /tpaall");

        }else{

            $s->sendMessage("Teleporting...");
            foreach($this->plugin->getServer()->getOnlinePlayers() as $player){
            	$player->teleport($sender->asPosition());
            }
 
        }

     return true;

   }

}
