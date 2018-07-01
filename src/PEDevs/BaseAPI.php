<?php

namespace PEDevs;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class BaseAPI extends PluginBase{

    /** @var BaseAPI */
    private static $api;
    /** @var Config */
    public $warn;
    
    public function onLoad(){
        self::$api = $this;
    }

    public function onEnable(){
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . "Players/");

        CommandManager::init();

        $this->getLogger()->info(TextFormat::GOLD . $this->getName() . TextFormat::GREEN . " activated!");
    }

    public static function getInstance() : BaseAPI{
        return self::$api;
    }

    public function getFileControl(string $name) : void{
        $dir = $this->getDataFolder() . $name . ".yml";
        if(!file_exists($dir)) $this->warn = new Config($dir, Config::YAML);
    }

    public function setWarn(string $name, string $reason, int $point) : void{
        $this->getFileControl($name);

        $data = new Config($this->getDataFolder() . $name . ".yml", Config::YAML);
        $data->set($reason, $point);
        $data->save();

        $this->getPointControl($name);
    }

    public function getPointControl(string $name) : void{
        $data = new Config($this->getDataFolder() . $name . ".yml", Config::YAML);
        $points = array_sum($data->getAll());

        $player = $this->getServer()->getPlayer($name);
        if($points >= 10){
            $player->kick(TextFormat::RED . "You have been removed from the server since you reached 10 points.");
            $player->setBanned(true);
        }
    }
}