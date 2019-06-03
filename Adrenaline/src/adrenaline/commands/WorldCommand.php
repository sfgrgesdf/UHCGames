<?php
declare(strict_types=1);

namespace adrenaline\commands;

use adrenaline\Loader;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\command\utils\InvalidCommandSyntaxException;
use pocketmine\utils\TextFormat;

class WorldCommand extends PluginCommand{
	public function __construct(Loader $plugin){
		parent::__construct("world", $plugin);
		$this->setPermission("adrenaline.cmd.world");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if(count($args) === 1){
			$worldManager = $sender->getServer()->getWorldManager();
			$worldManager->loadWorld($args[0]);
			if(($level = $worldManager->getWorldByName($args[0])) !== null){
				$sender->teleport($level->getSafeSpawn());
				$sender->sendMessage("Teleported to Level: " . $level->getFolderName());
				return true;
			}else{
				$sender->sendMessage(TextFormat::RED . "World: \"" . $args[0] . "\" does not exist");
				return false;
			}
		}else{
			throw new InvalidCommandSyntaxException();
		}
	}
}