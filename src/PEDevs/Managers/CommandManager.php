<?php

namespace PEDevs\Managers;

use PEDevs\Commands\{Feed, Heal, Fly, Repair, Spawn, Warn, Tpa, TpaAll, Tpak, Tpar, Broadcast, AFK};
use pocketmine\utils\TextFormat;
use PeDevs\BaseAPI;

class CommandManager{

    public static function init() : void{
         $api = BaseAPI::getInstance();

         $api->getServer()->getCommandMap()->registerAll("PEDevsEssentials", self::getCommands());

        $api->getLogger()->notice(TextFormat::DARK_GRAY . self::getCommandCount() . TextFormat::LIGHT_PURPLE . " commands have been loaded.");
    }

    public static function getCommands() : array{
        return [
            new Feed,
            new Heal,
            new Repair,
            new Spawn,
            new Warn,
            new Tpa,
            new Tpak,
            new Tpar,
            new TpaAll,
            new Broadcast,
            new AFK,
            new Fly
        ];
    }

    public static function getCommandCount() : int{
        return count(self::getCommands());
    }
}