<?php
declare(strict_types=1);

namespace rarkhopper\fireworks_particle;

use pocketmine\math\Vector3;
use pocketmine\world\particle\Particle;
use pocketmine\network\mcpe\protocol\ClientboundPacket;

class FireworkParticle implements Particle{
	protected array $patterns;
	protected FireworkNBTFactory $nbt_factory;
	protected NBTtoPacketsConverter $converter;
	
	/**
	 * @param BurstPattern ...$patterns
	 */
	public function __construct(BurstPattern ...$patterns){
		$this->patterns = $patterns;
		$this->nbt_factory = new FireworkNBTFactory;
		$this->converter = new NBTtoPacketsConverter;
	}
	
	/**
	 * @param Vector3 $pos
	 * @return ClientboundPacket[]
	 */
	public function encode(Vector3 $pos):array{
		$nbt = $this->nbt_factory->getFireworkNBT(...$this->patterns);
		return $this->converter->getSounds($nbt, $pos) + $this->converter->getActorPackets($nbt, $pos);
	}
}