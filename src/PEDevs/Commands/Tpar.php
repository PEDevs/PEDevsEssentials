<?php
/*
  _____  ____    _     ____  
 |_   _||  _ \  / \   |  _ \ 
   | |  | |_) |/ _ \  | |_) |
   | |  |  __// ___ \ |  _ < 
   |_|  |_|  /_/   \_\|_| \_\
                       
*/                            
namespace PEDevs\Commands;

use PEDevs\BaseAPI;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\Player;

use pocketmine\utils\TextFormat;

class Tpar extends Command{

    /** @var BaseAPI */

    private $plugin;

    public function __construct(){

    $this->plugin = BaseAPI::getInstance();

    parent::__construct("tpar", "Tpar command!");

    $this->setPermission("essentials.tpar.commands");

    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{

      if(!$this->testPermission($sender)) return false;

        if(!empty($args[0])){

            $sender->sendMessage(TextFormat::RED."Use: /tpak");

        }else{

            $this->plugin->tpar($sender->getName());

        }

     return true;

   }

}
