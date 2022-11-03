<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

class BurstPattern{
	protected FireworkType $type;
	protected FireworkColor $color;
	protected string $fade;
	protected int $flicker;
	protected int $trail;
	
	/**
	 * @param FireworkType $type
	 * @param FireworkColor $color
	 * @param string $fade
	 * @param int $flicker
	 * @param int $trail
	 */
	public function __construct(FireworkType $type, FireworkColor $color, string $fade = '', int $flicker = 0, int $trail = 0){
		$this->type = $type;
		$this->color = $color;
		$this->fade = $fade;
		$this->flicker = $flicker;
		$this->trail = $trail;
	}
	
	/**
	 * @return FireworkType
	 */
	public function getType():FireworkType{
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