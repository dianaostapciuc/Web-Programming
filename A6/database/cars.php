<?php
class Cars {
    public $id;
    public $model;
    public $engine_power;
    public $fuel;
    public $price;
    public $color;
    public $age;
    public $history_car;

    function __construct($id, $model, $engine_power, $fuel, $price, $color, $age, $history_car) {
        $this->id = $id;
        $this->model = $model;
        $this->engine_power = $engine_power;
        $this->fuel = $fuel;
        $this->price = $price;
        $this->color = $color;
        $this->age = $age;
        $this->history_car = $history_car;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getModel() {
        return $this->model;
    }

    function setModel($model) {
        $this->model = $model;
    }

    function getEngine() {
        return $this->engine_power;
    }

    function setEngine($engine_power) {
        $this->engine_power = $engine_power;
    }

    function getFuel() {
        return $this->fuel;
    }

    function setFuel($fuel) {
        $this->fuel = $fuel;
    }

    function getPrice() {
        return $this->price;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function getColor() {
        return $this->color;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function getAge() {
        return $this->age;
    }

    function setAge($age) {
        $this->age = $age;
    }

    function getHistoryCar() {
        return $this->history_car;
    }

    function setHistoryCar($history_car) {
        $this->history_car = $history_car;
    }
}
