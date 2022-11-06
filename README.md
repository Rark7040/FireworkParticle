
<samp>
<div align="center">

# FireworkParticle

</div>

PocketMine-MPのパーティクルのように花火を出せるようになるVirionライブラリです。<br>
`PocketMine-MP v4.10.0`以上でのみ動作が保証されます。
<br>
<br>
<br>


## ・Usage
```php 
use rarkhopper\firework_particle\FireworkParticle;
use rarkhopper\firework_particle\BurstPattern;
use rarkhopper\firework_particle\FireworkTypeEnum;
use rarkhopper\firework_particle\FireworkColor;
use rarkhopper\firework_particle\FireworkColorEnum;

/** @var \pocketmine\world\World $world*/
$world;
/** @var \pocketmine\math\Vector3 $v*/
$v;

$world->addParticle($v, new FireworkParticle(
	new BurstPattern(
		FireworkTypeEnum::SMALL_SPHERE(),
		new FireworkColor(FireworkColorEnum::RED())
	)
));

```
<br>
<br>
<br>

## ・Install
1. [VirionTools](https://github.com/ifera-mc/VirionTools)を`plugins`の中に配置します
2. サーバーを再起動します
3. `plugin_data/VirionTools/builds`にダウンロードした`FireworkParticle.phar`を配置します
4. コマンドラインより、`$ iv FireworkParticle [導入したいプラグインの名前]`を実行します <br>
   <br>
</samp>


