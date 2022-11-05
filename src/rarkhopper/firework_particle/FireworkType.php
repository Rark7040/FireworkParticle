<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

use pocketmine\utils\EnumTrait;

/**
 * @method static FireworkType SMALL_SPHERE()
 * @method static FireworkType HUGE_SPHERE()
 * @method static FireworkType STAR()
 * @method static FireworkType CREEPER_HEAD()
 * @method static FireworkType BURST()
 */
class FireworkType{
	use EnumTrait {
		__construct as enum___construct;
	}
	
	protected int $type;
	
	/**
	 * @return void
	 */
	protected static function setup() : void{
		self::registerAll(
			new self('small_sphere', 0),
			new self('huge_sphere', 1),
			new self('star', 2),
			new self('creeper_head', 3),
			new self('burst', 4),
		);
	}
	
	/**
	 * @param string $enum_name
	 * @param int $type
	 */
	private function __construct(string $enum_name, int $type){
		$this->enum___construct($enum_name);
		$this->type = $type;
	}
	
	/**
	 * @return int
	 */
	public function getType():int{
		return $this->type;
	}
	
	/**
	 * @param int $value
	 * @return static|null
	 */
	public static function getByValue(int $value):?self{
		foreach(self::getAll() as $type){
			if($type->getType() === $value) return $type;
		}
		return null;
	}
	
	/**
	 * @return static
	 */
	public static function randomType():self{
		$types = array_values(FireworkType::getAll());
		return $types[mt_rand(0, count($types)-1)];
	}
}