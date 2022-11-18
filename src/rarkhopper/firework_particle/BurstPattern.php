<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

class BurstPattern{
	private FireworkTypeEnum $type;
	private FireworkColor $color;
	private FireworkColor $fade;
	private bool $flicker;
	private bool $trail;
	private bool $sound;
	
	/**
	 * @param FireworkTypeEnum $type
	 * @param FireworkColor $color
	 * @param FireworkColor|null $fade
	 * @param bool $flicker
	 * @param bool $trail
	 * @param bool $sound
	 */
	public function __construct(
		FireworkTypeEnum $type,
		FireworkColor $color,
		?FireworkColor $fade = null,
		bool $flicker = false,
		bool $trail = false,
		bool $sound = true
	){
		$this->type = $type;
		$this->color = $color;
		$this->fade = $fade?? new FireworkColor;
		$this->flicker = $flicker;
		$this->trail = $trail;
		$this->sound = $sound;
	}
	
	/**
	 * @return FireworkTypeEnum
	 */
	public function getType():FireworkTypeEnum{
		return $this->type;
	}
	
	/**
	 * @return FireworkColor
	 */
	public function getColor():FireworkColor{
		return $this->color;
	}
	
	/**
	 * @return FireworkColor
	 */
	public function getFade():FireworkColor{
		return $this->fade;
	}
	
	/**
	 * @return bool
	 */
	public function isEnabledFlicker():bool{
		return $this->flicker;
	}
	
	/**
	 * @return bool
	 */
	public function isEnabledTrail():bool{
		return $this->trail;
	}

	/**
	 * @return bool
	 */
	public function isEnabledSound():bool{
		return $this->sound;
	}
}