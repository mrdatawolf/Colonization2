<?php namespace Old;

use Illuminate\Database\Eloquent\Model;

class Components extends Model
{

    public $id;
    public $title;

    protected $data;
    protected $ingotData;
    protected $baseValue;
    protected $scarcityAdjustedValue;
    protected $keenCrapFix;

    public function __construct($id)
    {

        $this->id      = $id;
        $this->gatherData();
        $this->setBaseValue();
        $this->scarcityAdjustedValue = 1;
        $this->keenCrapFix = 1;

    }

    private function gatherData() {
        $this->data = $this->find('components', $this->id);
        $this->title = $this->data->title;
    }

    private function setBaseValue() {
        $systemOres = [];

        /*foreach($this->cluster->ores as $ores) {
            $oreName = $ores->getName();
            $systemOres[$oreName] = $this->data->$$oreName;
        }*/
        //todo::get the real base value;
        $this->ddng($systemOres);
        //$this->baseValue = $this->data['oreRequired']*$this->oreClass->getStoreAdjustedValue();
        $this->baseValue = 1;
    }

    public function getName() {
        return $this->title;
}

    public function getData() {
        return $this->data;
    }

    public function getBaseValue() {
        return $this->baseValue;
    }

    public function getStoreAdjustedMinimum() {
        return $this->baseValue*$this->keenCrapFix;
    }

    public function getScarcityAdjustedValue() {
        return $this->scarcityAdjustedValue;
    }

    public function getKeenCrapFix() {
        return $this->keenCrapFix;
    }

    public function getIngotAmountNeeded($ingotId) {
        $this->ingotData = $this->find('ingots', $ingotId);
        $ingotTitle = $this->ingotData->title;
        return $this->data[$ingotTitle];
    }

    public function getComponentMass() {
        return $this->data->mass;
    }

    public function getComponentVolume() {
        return $this->data->volume;
    }

    public function getDensity() {
        return (empty($this->data->mass)) ? 0 : $this->data->mass/$this->data->volume;
    }
}