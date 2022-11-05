<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

class BurstPattern{
	protected FireworkTypeEnum $type;
	protected FireworkColor $color;
	protected FireworkColor $fade;
	protected int $flicker;
	protected int $trail;
	
	/**
	 * @param FireworkTypeEnum $type
	 * @param FireworkColor $color
	 * @param FireworkColor|null $fade
	 * @param bool $flicker
	 * @param bool $trail
	 */
	public function __construct(FireworkTypeEnum $type, FireworkColor $color, ?FireworkColor $fade = null, bool $flicker = false, bool $trail = false){
		$this->type = $type;
		$this->color = $color;
		$this->fade = $fade?? '';
		$this->flicker = (int) $flicker;
		$this->trail = (int) $trail;
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
	 * @return string
	 */
	public function getFade():string{
		return $this->fade;
	}
	
	/**
	 * @return int
	 */
	public function getFlicker():int{
		return $this->flicker;
	}
	
	/**
	 * @return int
	 */
	public function getTrail():int{
		return $this->trail;
	}
}