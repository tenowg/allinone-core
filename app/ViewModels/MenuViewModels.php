<?php

namespace App\ViewModels\MenuViewModels;

class Menu {
    public $items = [];

    public function addItem(Section $item) {
        if (count($item->items) > 0) {
            array_push($this->items, $item);
        }
        return $this;
    }
}

class Section {
    public $name;
    public $items = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addItem(SubMenu $item) {
        array_push($this->items, $item);
        return $this;
    }
}

class SubMenu {
    public $name; 
    public $icon;
    public $items = [];

    public function __construct(string $name, string $icon = null)
    {
        $this->name = $name;
        $this->icon = $icon;
    }

    public function addItem(MenuItem $item) {
        array_push($this->items, $item);
        return $this;
    }
}

class MenuItem {
    public $name;
    public $link;

    public function __construct(string $name, string $link)
    {
        $this->name = $name;
        $this->link = $link;    
    }
}