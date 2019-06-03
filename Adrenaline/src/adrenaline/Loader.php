<?php
declare(strict_types=1);

namespace adrenaline;

use adrenaline\commands\WorldCommand;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase{
	public function onEnable(){
		new EventListener($this);
		$map = $this->getServer()->getCommandMap();

		$map->registerAll("adrenaline", [
			new WorldCommand($this)
		]);
	}
}