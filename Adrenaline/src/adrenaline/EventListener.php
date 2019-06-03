<?php
declare(strict_types=1);

namespace adrenaline;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;

class EventListener implements Listener{

	private $plugin;

	public function __construct(Loader $plugin){
		$plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
	}

	public function handleJoin(PlayerJoinEvent $ev){
		$player = $ev->getPlayer();

		$pk = new GameRulesChangedPacket();
		$pk->gameRules = ["showcoordinates" => [1, true]];
		//$player->sendDataPacket($pk);
	}
}