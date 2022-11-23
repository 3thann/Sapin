<?php

class Tree {

    private $chars = [
        "returnLine" => "\r\n",
        "star" => "*",
        "space" => "&nbsp"
    ];
    public $config = [
        "test" => true,
        "nb_stages" => 3,
    ];

    public function __construct($nb_stages)
    {
        $this->config["nb_stages"] = $nb_stages;
        $this->tree();
    }

    private function oneLine($stars) {

        $max_width = $this->getMaxWidth();
        $spaces = ($max_width - $stars) / 2;
    
        for($i=0; $i < $spaces; $i++) {
            echo( $this->chars["space"] );
        }
        for($i=0; $i < $stars; $i++) {
            echo( $this->chars["star"] );
        }
        for($i=0; $i < $spaces; $i++) {
            echo( $this->chars["space"] );
        }
        $this->returnLine();
    }

    private function getMaxWidth() {
        return $this->config["nb_stages"] * 4 + 3;
    }

    private function returnLine()
    {
        if( $this->config["test"] == true) {
            echo($this->chars["returnLine"]);
        } else {
            echo(nl2br($this->chars["returnLine"]));
        }
    }

    private function triangle($base_stars, $first = false) {
        $this->oneLine($base_stars);
        if($first == true) {
            $this->oneLine($base_stars + 2);
            $this->oneLine($base_stars + 6);
        } else {
            $this->oneLine($base_stars + 4);
            $this->oneLine($base_stars + 8);
        }
    }

    public function tree() {
        $y = 0;
        if( $this->config["test"] == true) {
            echo('<pre style="padding-left: 200px;">');
        }
        $this->triangle(1, true);
        for($i=1; $i <= $this->config["nb_stages"] - 1; $i++) {
            if($i == 1) {
                $y += 3;
            } else {
                $y += 4;
            }
            // valeurs triangle
            $this->triangle($y);
        }
        $this->trunk();
        if( $this->config["test"] == true) {
            echo("</pre>");
        }
    }

    private function trunk() {
        for($i=0; $i < 4; $i++) {
            $this->oneLine(3);
        }
    }
}

new Tree(7);