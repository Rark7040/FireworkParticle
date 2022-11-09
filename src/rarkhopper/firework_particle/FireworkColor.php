<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

class FireworkColor{
	private string $colors = '';
	
	/**
	 * @param FireworkColorEnum ...$colors
	 */
	public function __construct(FireworkColorEnum ...$colors){
		foreach($colors as $color){
			$this->addColor($color);
		}
	}
	
	/**
	 * @param FireworkColorEnum $color
	 * @return void
	 */
	public function addColor(FireworkColorEnum $color):void{
		$this->colors .= $color->getColor();
	}
	
	/**
	 * @return string
	 */
	public function getColors():string{
		return $this->colors;
	}
}