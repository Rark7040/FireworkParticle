<?php
declare(strict_types=1);

namespace rarkhopper\fireworks_particle;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;

class FireworkNBTFactory{
	const NBT_FIREWORKS = 'Fireworks';
	const NBT_FIREWORK_TYPE = 'FireworkType';
	const NBT_FIREWORK_COLOR = 'FireworkColor';
	const NBT_FIREWORK_FADE = 'FireworkFade';
	const NBT_FIREWORK_FLICKER = 'FireworkFlicker';
	const NBT_FIREWORK_TRAIL = 'FireworkTrail';
	const NBT_FIREWORK_EXPLOSIONS = 'Explosions';
	
	/**
	 * @param BurstPattern ...$patterns
	 * @return CompoundTag
	 */
	public function getFireworkNBT(BurstPattern ...$patterns):CompoundTag{
		$nbt = $this->createDefaultTag();
		
		foreach ($patterns as $pattern){
			$this->input($nbt, $pattern);
		}
		return $nbt;
	}
	
	/**
	 * @return CompoundTag
	 */
	protected function createDefaultTag():CompoundTag{
		$tag = new CompoundTag;
		$tag->setTag(self::NBT_FIREWORKS, new CompoundTag);
		return $tag;
	}
	
	/**
	 * @param CompoundTag $tag
	 * @param BurstPattern $pattern
	 * @return void
	 */
	protected function input(CompoundTag $tag, BurstPattern $pattern):void{
		$explosion = new CompoundTag;
		$explosion->setByte(self::NBT_FIREWORK_TYPE, $pattern->getType()->getType());
		$explosion->setByteArray(self::NBT_FIREWORK_COLOR, $pattern->getColor()->getColor());
		$explosion->setByteArray(self::NBT_FIREWORK_FADE, $pattern->getFade());
		$explosion->setByte(self::NBT_FIREWORK_FLICKER, $pattern->getFlicker());
		$explosion->setByte(self::NBT_FIREWORK_TRAIL, $pattern->getTrail());
		$explosions = $tag->getListTag(self::NBT_FIREWORK_EXPLOSIONS)?? new ListTag();
		$explosions->push($explosion);
		$tag->setTag(self::NBT_FIREWORK_EXPLOSIONS, $explosions);
	}
}