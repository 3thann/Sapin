<?php

class Config {

    public $nb_stages = 5;
    public $test = true;
}

class Line {

    public $stars;
    private $chars = [
        "returnLine" => "\r\n",
        "star" => "*",
        "space" => "&nbsp"
    ]; 
    public $config;

    public function __construct($stars) {
        $this->stars = $stars;
        $this->config = new Config();
        $this->draw();
    }

    private function getMaxWidth() {
        return $this->config->nb_stages * 4 + 3;
    }

    private function returnLine() {
        if( $this->config->test == true) {
            echo($this->chars["returnLine"]);
        } else {
            echo(nl2br($this->chars["returnLine"]));
        }
    }

    public function draw() {

        $spaces = ($this->getMaxWidth() - $this->stars) / 2;
    
        for($i=0; $i < $spaces; $i++) {
            echo( $this->chars["space"] );
        }
        for($i=0; $i < $this->stars; $i++) {
            echo( $this->chars["star"] );
        }
        for($i=0; $i < $spaces; $i++) {
            echo( $this->chars["space"] );
        }
        $this->returnLine();
    }
}

class Trunk {

    public $config;

    public function __construct(){
        $this->config = new Config();
        $this->draw();
    }

    public function draw() {
        for($i=0; $i < 4; $i++) {
            new Line(3);
        }
    }
}

class Triangle {

    public $base_stars;
    public $first;

    public function __construct($base_stars, $first = false){
        $this->base_stars = $base_stars;
        $this->first = $first;
        $this->draw();
    }

    private function oneLine($stars) {
        new Line($this->base_stars);
    }

    private function draw() {
        $this->oneLine($this->base_stars);
        if($this->first == true) {
            $this->oneLine($this->base_stars += 2);
            $this->oneLine($this->base_stars += 6);
        } else {
            $this->oneLine($this->base_stars += 4);
            $this->oneLine($this->base_stars += 8);
        }
    } 
}

class Tree {

    public $config;

    public function __construct($nb_stages) {
        $this->config = new Config();
        $this->config->nb_stages = $nb_stages;
        $this->tree();
    }

    public function tree() {
        $y = 0;
        if( $this->config->test == true) {
            echo('<pre style="padding-left: 200px;">');
        }

        new Triangle(1, true);
        for($i=1; $i <= $this->config->nb_stages - 1; $i++) {
            if($i == 1) {
                $y += 3;
            } else {
                $y += 4;
            }
            // valeurs triangle
            new Triangle($y);
        }
        new Trunk();
        if( $this->config->test == true) {
            echo("</pre>");
        }
    }
}

new Tree(3);