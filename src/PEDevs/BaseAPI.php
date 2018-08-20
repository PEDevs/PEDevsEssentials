<?php

declare(strict_types=1);

namespace PEDevs;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use PEDevs\Managers\CommandManager;
    
class BaseAPI extends PluginBase{

    /** @var BaseAPI $api */
    private static $api;

    /** @var Config $warn */
    public $warn;

    /** @var array[] $invite */
    public $invite = [];
    
    /** @var array[] $afks */
    public $afks = [];
    
    public function onLoad(){
        self::$api = $this;
    }

    public function onEnable(){
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . "players/");

        CommandManager::init();

        $this->getLogger()->info(TextFormat::GOLD . $this->getName() . TextFormat::GREEN . " aktifleştirildi!");
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
            $player->kick(TextFormat::RED . "10 puan aldığın için sunucudan uzaklaştırıldın!");
            $player->setBanned(true);
        }
    }
    
    public function setInvite(Player $sender, Player $player) : void{
        $this->invite[$player->getName()] = $sender->getName();
    }
    
    public function isInvited(string $name) : bool{
        return isset($this->invite[$name]);
    }
    
    public function getInvite($name) : string{
        return $this->invite[$name];
    }
    
    public function tpak(string $name) : void{
        $player = $this->getServer()->getPlayer($name);
        if($this->isInvited($name)){
            $sender = $this->getServer()->getPlayer($this->getInvite($name));
            $sender->teleport($player->asPosition());
            unset($this->invite[$name]);
            $sender->sendMessage(TextFormat::AQUA . $name . " Işınlanma isteğinizi kabul etti.");
        }else{
            $player->sendMessage(TextFormat::RED . "Davet almamışsınız.");
        }
    }
     
    public function tpar($name) : void{
           $player = $this->getServer()->getPlayer($name);
        if($this->isInvited($name)){
            $sender = $this->getServer()->getPlayer($this->getInvite($name));
            unset($this->invite[$name]);
            $sender->sendMessage(TextFormat::AQUA . $name . TextFormat::RED . " Işınlanma isteğinizi reddetti");

        }else{
            $player->sendMessage(TextFormat::RED . "Davet almamışsınız.");
        }
    }

    public function getAfkState(Player $player): ?bool{
        return isset($this->afks[$player->getName()]) ? $this->afks[$player->getName()] : null;
    }

    public function setAfkState(Player $player, string $state = "no-afk"): void{
        $this->afks[$player->getName()] = $state;
    }
}