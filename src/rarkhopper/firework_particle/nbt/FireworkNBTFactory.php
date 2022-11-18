<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle\nbt;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use rarkhopper\firework_particle\BurstPattern;

class FireworkNBTFactory{
	public const NBT_FIREWORKS = 'Fireworks';
	public const NBT_FIREWORK_TYPE = 'FireworkType';
	public const NBT_FIREWORK_COLOR = 'FireworkColor';
	public const NBT_FIREWORK_FADE = 'FireworkFade';
	public const NBT_FIREWORK_FLICKER = 'FireworkFlicker';
	public const NBT_FIREWORK_TRAIL = 'FireworkTrail';
	public const NBT_FIREWORK_EXPLOSIONS = 'Explosions';
	
	/**
	 * @param BurstPattern $pattern
	 * @return CompoundTag
	 */
	public function getFireworkNBT(BurstPattern $pattern):CompoundTag{
		$nbt = $this->createDefaultTag();
		$this->input($nbt, $pattern);
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
		$explosion
			->setByte(self::NBT_FIREWORK_TYPE, $pattern->getType()->getType())
			->setByteArray(self::NBT_FIREWORK_COLOR, $pattern->getColor()->getColors())
			->setByteArray(self::NBT_FIREWORK_FADE, $pattern->getFade()->getColors())
			->setByte(self::NBT_FIREWORK_FLICKER, $pattern->isEnabledFlicker()? 1: 0)
			->setByte(self::NBT_FIREWORK_TRAIL, $pattern->isEnabledTrail()? 1: 0);
		$explosions = $tag->getListTag(self::NBT_FIREWORK_EXPLOSIONS)?? new ListTag();
		$explosions->push($explosion);
		$tag->getCompoundTag(self::NBT_FIREWORKS)?->setTag(self::NBT_FIREWORK_EXPLOSIONS, $explosions);
	}
}