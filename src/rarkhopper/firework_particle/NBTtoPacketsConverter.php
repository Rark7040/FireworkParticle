<?php
declare(strict_types=1);

namespace rarkhopper\fireworks_particle;

use Generator;
use LogicException;
use pocketmine\entity\Entity;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\network\mcpe\protocol\types\ActorEvent;
use pocketmine\network\mcpe\protocol\types\CacheableNbt;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\network\mcpe\protocol\types\entity\PropertySyncData;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\Server;

class NBTtoPacketsConverter{
	public function validateNBT(CompoundTag $nbt):bool{
		return $this->getExplosionsTag($nbt) !== null;
	}
	
	/**
	 * @param CompoundTag $nbt
	 * @param Vector3 $v
	 * @return array<ClientboundPacket>
	 */
	public function getSounds(CompoundTag $nbt, Vector3 $v):array{
		if(!$this->validateNBT($nbt)){
			Server::getInstance()->getLogger()->error('nbt is invalid');
			return [];
		}
		$explosions = $this->getExplosionsTag($nbt);
		$sounds = [];
		
		if($explosions === null) throw new LogicException('explosions is null');
		foreach($explosions->getAllValues() as $explosion){
			$type = $explosion[FireworkNBTFactory::NBT_FIREWORK_TYPE]?? throw new LogicException('type was not input');
			
			if(!$type instanceof ByteTag) throw new LogicException('type is must be a ByteTag given '.get_class($type));
			$sounds[] =  $this->createSoundPacket($type->getValue(), $v);
		}
		return $sounds;
	}
	
	/**
	 * @param CompoundTag $nbt
	 * @return ListTag|null
	 */
	protected function getExplosionsTag(CompoundTag $nbt):?ListTag{
		return $nbt
				->getCompoundTag(FireworkNBTFactory::NBT_FIREWORKS)
				?->getListTag(FireworkNBTFactory::NBT_FIREWORK_EXPLOSIONS)?? null;
	}
	
	/**
	 * @param int $value
	 * @param Vector3 $v
	 * @return LevelSoundEventPacket
	 */
	protected function createSoundPacket(int $value, Vector3 $v):LevelSoundEventPacket{
		$enum_type = FireworkType::getByValue($value);
		return match(true){
			FireworkType::SMALL_SPHERE()->equals($enum_type)
			=> LevelSoundEventPacket::create(
				LevelSoundEvent::BLAST,
				$v,
				0,
				'',
				false,
				false
			),
			FireworkType::HUGE_SPHERE()->equals($enum_type)
			=> LevelSoundEventPacket::create(
				LevelSoundEvent::LARGE_BLAST,
				$v,
				0,
				'',
				false,
				false
			),
			FireworkType::STAR()->equals($enum_type),
			FireworkType::CREEPER_HEAD()->equals($enum_type),
			FireworkType::BURST()->equals($enum_type),
			=> LevelSoundEventPacket::create(
				LevelSoundEvent::LARGE_BLAST,
				$v,
				0,
				'',
				false,
				false
			),
			default => throw new LogicException('Unexpected match value')
		};
	}
	
	/**
	 * @param CompoundTag $nbt
	 * @param Vector3 $v
	 * @return array<ClientboundPacket>
	 */
	public function getActorPackets(CompoundTag $nbt, Vector3 $v):array{
		if(!$this->validateNBT($nbt)){
			Server::getInstance()->getLogger()->error('nbt is invalid');
			return [];
		}
		$eid = Entity::nextRuntimeId();
		$prop_mng = new EntityMetadataCollection;
		$prop_mng->setCompoundTag(EntityMetadataProperties::MINECART_DISPLAY_BLOCK, new CacheableNbt($nbt));
		return [
			AddActorPacket::create($eid, $eid, EntityIds::FIREWORKS_ROCKET, $v, null, 0, 0, 0, 0,  [], $prop_mng->getAll(), new PropertySyncData([], []), []),
			ActorEventPacket::create($eid, ActorEvent::FIREWORK_PARTICLES, 0),
			RemoveActorPacket::create($eid)
		];
	}
}