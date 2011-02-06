<?php

class SeedItemEntity extends AbstractEntity {
	protected $id;
	protected $seedId;
	protected $name;
	protected $resistence;
	protected $color;
	protected $position;
	protected $w1; protected $w2; protected $w3; protected $w4; protected $w5; 
	protected $w6; protected $w7; protected $w8; protected $w9; protected $w10;
	protected $w11; protected $w12; protected $w13; protected $w14; protected $w15;
	protected $w16; protected $w17; protected $w18; protected $w19; protected $w20;
	protected $w21; protected $w22; protected $w23; protected $w24; protected $w25;
	protected $w26; protected $w27; protected $w28; protected $w29; protected $w30;
	protected $w31; protected $w32; protected $w33; protected $w34; protected $w35;
	protected $w36; protected $w37; protected $w38; protected $w39; protected $w40;
	protected $w41; protected $w42; protected $w43; protected $w44; protected $w45;
	protected $w46; protected $w47; protected $w48; protected $w49; protected $w50;
	protected $w51; protected $w52;
	
	public function __construct($id = null, $seedId = null, $name = null, $resistence = null, $color = null, $position = null, $weeks = null) {
		if (is_array($id)) {
			$this->fromArray($id);
		} else {
			$this->setId($id);
			$this->setSeedId($seedId);
			$this->setName($name);
			$this->setResistence($resistence);
			$this->setColor($color);
			$this->setPosition($position);
			if ($weeks !== null) {
				foreach ($weeks as $key => $week) {
					$this->set{$key}($week);
				}
			}
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getSeedId() {
		return $this->seedId;
	}
	
	public function setSeedId($seedId) {
		$this->seedId = $seedId;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getResistence() {
		return $this->resistence;
	}
	
	public function setResistence($resistence) {
		$this->resistence = $resistence;
	}
	
	public function getColor() {
		return $this->color;
	}
	
	public function setColor($color) {
		$this->color = $color;
	}
	
	public function getPosition() {
		return $this->position;
	}
	
	public function setPosition($position) {
		$this->position = $position;
	}
	
	public function getW1() { return $this->w1; } public function setW1($w1) { $this->w1 = $w1; }
	public function getW2() { return $this->w2; } public function setW2($w2) { $this->w2 = $w2; }
	public function getW3() { return $this->w3; } public function setW3($w3) { $this->w3 = $w3; }
	public function getW4() { return $this->w4; } public function setW4($w4) { $this->w4 = $w4; }
	public function getW5() { return $this->w5; } public function setW5($w5) { $this->w5 = $w5; }
	public function getW6() { return $this->w6; } public function setW6($w6) { $this->w6 = $w6; }
	public function getW7() { return $this->w7; } public function setW7($w7) { $this->w7 = $w7; }
	public function getW8() { return $this->w8; } public function setW8($w8) { $this->w8 = $w8; }
	public function getW9() { return $this->w9; } public function setW9($w9) { $this->w9 = $w9; }
	public function getW10() { return $this->w10; } public function setW10($w10) { $this->w10 = $w10; }
	public function getW11() { return $this->w11; } public function setW11($w11) { $this->w11 = $w11; }
	public function getW12() { return $this->w12; } public function setW12($w12) { $this->w12 = $w12; }
	public function getW13() { return $this->w13; } public function setW13($w13) { $this->w13 = $w13; }
	public function getW14() { return $this->w14; } public function setW14($w14) { $this->w14 = $w14; }
	public function getW15() { return $this->w15; } public function setW15($w15) { $this->w15 = $w15; }
	public function getW16() { return $this->w16; } public function setW16($w16) { $this->w16 = $w16; }
	public function getW17() { return $this->w17; } public function setW17($w17) { $this->w17 = $w17; }
	public function getW18() { return $this->w18; } public function setW18($w18) { $this->w18 = $w18; }
	public function getW19() { return $this->w19; } public function setW19($w19) { $this->w19 = $w19; }
	public function getW20() { return $this->w20; } public function setW20($w20) { $this->w20 = $w20; }
	public function getW21() { return $this->w21; } public function setW21($w21) { $this->w21 = $w21; }
	public function getW22() { return $this->w22; } public function setW22($w22) { $this->w22 = $w22; }
	public function getW23() { return $this->w23; } public function setW23($w23) { $this->w23 = $w23; }
	public function getW24() { return $this->w24; } public function setW24($w24) { $this->w24 = $w24; }
	public function getW25() { return $this->w25; } public function setW25($w25) { $this->w25 = $w25; }
	public function getW26() { return $this->w26; } public function setW26($w26) { $this->w26 = $w26; }
	public function getW27() { return $this->w27; } public function setW27($w27) { $this->w27 = $w27; }
	public function getW28() { return $this->w28; } public function setW28($w28) { $this->w28 = $w28; }
	public function getW29() { return $this->w29; } public function setW29($w29) { $this->w29 = $w29; }
	public function getW30() { return $this->w30; } public function setW30($w30) { $this->w30 = $w30; }
	public function getW31() { return $this->w31; } public function setW31($w31) { $this->w31 = $w31; }
	public function getW32() { return $this->w32; } public function setW32($w32) { $this->w32 = $w32; }
	public function getW33() { return $this->w33; } public function setW33($w33) { $this->w33 = $w33; }
	public function getW34() { return $this->w34; } public function setW34($w34) { $this->w34 = $w34; }
	public function getW35() { return $this->w35; } public function setW35($w35) { $this->w35 = $w35; }
	public function getW36() { return $this->w36; } public function setW36($w36) { $this->w36 = $w36; }
	public function getW37() { return $this->w37; } public function setW37($w37) { $this->w37 = $w37; }
	public function getW38() { return $this->w38; } public function setW38($w38) { $this->w38 = $w38; }
	public function getW39() { return $this->w39; } public function setW39($w39) { $this->w39 = $w39; }
	public function getW40() { return $this->w40; } public function setW40($w40) { $this->w40 = $w40; }
	public function getW41() { return $this->w41; } public function setW41($w41) { $this->w41 = $w41; }
	public function getW42() { return $this->w42; } public function setW42($w42) { $this->w42 = $w42; }
	public function getW43() { return $this->w43; } public function setW43($w43) { $this->w43 = $w43; }
	public function getW44() { return $this->w44; } public function setW44($w44) { $this->w44 = $w44; }
	public function getW45() { return $this->w45; } public function setW45($w45) { $this->w45 = $w45; }
	public function getW46() { return $this->w46; } public function setW46($w46) { $this->w46 = $w46; }
	public function getW47() { return $this->w47; } public function setW47($w47) { $this->w47 = $w47; }
	public function getW48() { return $this->w48; } public function setW48($w48) { $this->w48 = $w48; }
	public function getW49() { return $this->w49; } public function setW49($w49) { $this->w49 = $w49; }
	public function getW50() { return $this->w50; } public function setW50($w50) { $this->w50 = $w50; }
	public function getW51() { return $this->w51; } public function setW51($w51) { $this->w51 = $w51; }
	public function getW52() { return $this->w52; } public function setW52($w52) { $this->w52 = $w52; }
}
