<?php

namespace PEDevs;

use PEDevs\Commands\{Feed, Heal, Repair, Spawn, Warn, Tpa};
use pocketmine\utils\TextFormat;

class CommandManager{

    public static function init() : void{
        foreach(self::getCommands() as $key => $value){
            BaseAPI::getInstance()->getServer()->getCommandMap()->register($key, $value);
        }
        BaseAPI::getInstance()->getLogger()->notice(TextFormat::DARK_GRAY . self::getCommandCount() . TextFormat::LIGHT_PURPLE . " commands have been loaded.");
    }

    public static function getCommands() : array{
        return [
            "feed" => new Feed(),
            "heal" => new Heal(),
            "repair" => new Repair(),
            "spawn" => new Spawn(),
            "warn" => new Warn(),
            "tpa" => new Tpa()
        ];
    }

    public static function getCommandCount() : int{
        return count(self::getCommands());
    }
}
