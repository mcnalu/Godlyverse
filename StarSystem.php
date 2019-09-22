<?php

/**
 * Description of StarSystem
 *
 * @author nalu
 */
class StarSystem {
    private $id;
    private $time;
    private $name;
    private $G;
    private $theta;
    private $alpha1;
    private $alpha2;
    private $H;

    function __construct($time=0, $id=0, $name="sol",$H = 100., $theta = 0.2, $G = 30., $alpha1 = 0.2, $alpha2 = 0.2) {
        $this->time = $time;
        $this->id = $id;
        $this->name = $name;
        $this->H = $H;
        $this->theta = $theta;
        $this->G = $G;
        $this->alpha1 = $alpha1;
        $this->alpha2 = $alpha2;
    }

    function update() {
        $Y=$this->getY();
        $this->H += $Y * (1.0 - $this->theta) - $this->getC($Y);
        $this->time++;
    }

    function getUpdate(){
        $all['G']=$this->G;
        $all['theta']=$this->theta;
        $all['alpha1']=$this->alpha1;
        $all['alpha2']=$this->alpha2;
        $all['H']=$this->H;
        $all['time']=$this->time;
        
        return $all;
    }
    
    function getAll(){
        $all=$this->getUpdate();
        $all['name']=$this->name;
        $all['id']=$this->id;
        return $all;
    }
    
    function getG() {
        return $this->G;
    }
    
    function getH() {
        return $this->H;
    }

    function getY() {
        return ($this->G + $this->alpha2 * $this->H) / (1 - $this->alpha1 * (1 - $this->theta));
    }    
    
    function getC($Y = NULL) {
        $Y= is_null($Y) ? $this->getY() : $Y;
        return $this->alpha1 * $Y * (1.0 - $this->theta) + $this->alpha2 * $this->H;
    }
    
}
