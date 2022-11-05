<?php
declare(strict_types=1);

namespace rarkhopper\firework_particle;

use pocketmine\utils\EnumTrait;

/**
 * @method static FireworkColorEnum BLACK()
 * @method static FireworkColorEnum RED()
 * @method static FireworkColorEnum DARK_GREEN()
 * @method static FireworkColorEnum BROWN()
 * @method static FireworkColorEnum BLUE()
 * @method static FireworkColorEnum DARK_PURPLE()
 * @method static FireworkColorEnum DARK_AQUA()
 * @method static FireworkColorEnum GRAY()
 * @method static FireworkColorEnum DARK_GRAY()
 * @method static FireworkColorEnum PINK()
 * @method static FireworkColorEnum GREEN()
 * @method static FireworkColorEnum YELLOW()
 * @method static FireworkColorEnum LIGHT_AQUA()
 * @method static FireworkColorEnum DARK_PINK()
 * @method static FireworkColorEnum GOLD()
 * @method static FireworkColorEnum WHITE()
 *
 */
class FireworkColorEnum{
	use EnumTrait {
		__construct as enum___construct;
	}
	
	protected string $color_id;
	
	/**
	 * @return void
	 */
	protected static function setup() : void{
		self::registerAll(
			new self('black', "\x00"),
			new self('red', "\x01"),
			new self('dark_green', "\x02"),
			new self('brown', "\x03"),
			new self('blue', "\x04"),
			new self('dark_purple', "\x05"),
			new self('dark_aqua', "\x06"),
			new self('gray', "\x07"),
			new self('dark_gray', "\x08"),
			new self('pink', "\x09"),
			new self('green', "\x0a"),
			new self('yellow', "\x0b"),
			new self('light_aqua', "\x0c"),
			new self('dark_pink', "\x0d"),
			new self('gold', "\x0e"),
			new self('white', "\x0f")
		);
	}
	
	/**
	 * @param string $enum_name
	 * @param string $color_id
	 */
	private function __construct(string $enum_name, string $color_id){
		$this->enum___construct($enum_name);
		$this->color_id = $color_id;
	}
	
	/**
	 * @return string
	 */
	public function getColor():string{
		return $this->color_id;
	}
	
	/**
	 * @return static
	 */
	public static function randomColor():self{
		$colors = array_values(self::getAll());
		return $colors[mt_rand(0, count($colors)-1)];
	}
}