<?php

namespace DghDeV;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ExecutorCommand;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\item\Item;

use onebone\economyapi\EconomyAPI;

use jojoe77777\FormAPI\SimpleForm;


class Main extends PluginBase implements Listener{

    public function onEnable(){
       $this->getServer()->getPluginManager()->registerEvents($this, $this);
       $this->getLogger()->info("§l§aPlugin Enable.. By DghDeV");
    }

   public function onJoin(PlayerJoinEvent $event)
    {

        $player = $event->getPlayer();
        $name = $player->getName();
        $inv = $player->getInventory();
 
        $player->getInventory()->setItem(4, Item::get(345, 0, 1)->setCustomName("§l§bSERVER SELECTOR"));
    }

    public function onDisable(){
        $this->getLogger()->info("§c§lPlugin Disable.. By DghDeV");
    }


    public function onQuit(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
		 $inv = $player->getInventory();
        $inv->clearAll();
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    }

    public function OnInteract(PlayerInteractEvent $event){

        $player = $event->getPlayer();
        $name = $player->getName();
        $inv = $player->getInventory();
        $item = $event->getItem();

        if ($item->getId() == "345") {
        $this->MenuForm($player);
        }
    }

    public function onDrop(PlayerDropItemEvent $event){
    $player = $event->getPlayer();
    $item = $event->getItem();
    
        if($item->getId() == "345") {
            $event->setCancelled(true);
        }
    }

    public function MenuForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->OneBlockForm($sender);
                break;
                case 1:
                    $this->SkyBlockForm($sender);
                break;
                case 2:
                    $this->SkyTreeForm($sender);
                break;
                case 3:
                    $this->MinigamesForm($sender);
                break;
                case 4:
                    $sender->sendMessage("§cCancelled");
                break;
            }
        });
        $form->setTitle("§b§lSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lONEBLOCK\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lSKYBLOCK\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lSKYTREE\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lMINIGAMES\n§eTAP TO CONNECT", 0, "textures/ui/controller_glyph_color");
        $form->addButton("§lBACK", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
    }
    
    public function OneBlockForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer oneblock");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
    public function SkyBlockForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer skyblock");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
   public function SkyTreeForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer skytree");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
   
   public function MinigamesForm($sender){ 
        $form = new SimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $this->getServer()->getCommandMap()->dispatch($sender, "transfer minigames");
                break;
                case 1:
                    $this->MenuForm($sender);
                break;
            }
        });
        $form->setTitle("§l§bSERVER SELECTOR");
        $form->setContent("");
        $form->addButton("§lYES", 0, "textures/ui/confirm");
        $form->addButton("§lNO", 0, "textures/ui/cancel");
        $form->sendToPlayer($sender);
        return ($form);
   }
}
