<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

use pocketmine\math\Vector3;
use pocketmine\world\particle\Particle;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use rarkhopper\firework_particle\nbt\FireworkNBTFactory;
use rarkhopper\firework_particle\nbt\NBTtoPacketsConverter;

class FireworkParticle implements Particle{
	private BurstPattern $pattern;
	private FireworkNBTFactory $nbt_factory;
	private NBTtoPacketsConverter $converter;
	
	/**
	 * @param BurstPattern $pattern;
	 */
	public function __construct(BurstPattern $pattern){
		$this->pattern = $pattern;
		$this->nbt_factory = new FireworkNBTFactory;
		$this->converter = new NBTtoPacketsConverter;
	}
	
	/**
	 * @param Vector3 $pos
	 * @return ClientboundPacket[]
	 */
	public function encode(Vector3 $pos):array{
		$nbt = $this->nbt_factory->getFireworkNBT($this->pattern);
		return array_merge(
			$this->pattern->isEnabledSound()? $this->converter->getSounds($nbt, $pos): [],
			$this->converter->getActorPackets($nbt, $pos)
		);
	}
}