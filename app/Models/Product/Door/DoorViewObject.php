<?php

namespace App\Models\Product\Door;

class DoorViewObject
{
    private $id;

    /**
     * @var mixed
     */
    private $category_name;

    private $name;

    private $door_type_name;

    private $size;

    private $price;

    private $handling;

    private $frame;

    private $color;

    private $grid;

    private $glass_grid;

    private $glass_option;

    private $glassoption;

    private $lowe;

    private $depth;

    private $handle;

    private $lock;

    private $thickness;

    private $notes;

    private $quantity;

    private $spec;

    private $screen_option;

    private $frame_thickness_option;

    private $dp_option;

    private $lite_option;

    private $sill_option;

    private $blind_option;


    private $handle_color;

    private $lock_color;

    private $sill_color;

    private $hing_color;

    private $assemble_knock;

    private $mull_kit;
    //private $quantity;

    //private $spec;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category_name
     */
    public function setCategoryName($category_name): void
    {
        $this->category_name = $category_name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDoorTypeName()
    {
        return $this->door_type_name;
    }

    /**
     * @param mixed $door_type_name
     */
    public function setDoorTypeName($door_type_name): void
    {
        $this->door_type_name = $door_type_name;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getHandling()
    {
        return $this->handling;
    }

    /**
     * @param mixed $handling
     */
    public function setHandling($handling): void
    {
        $this->handling = $handling;
    }

    /**
     * @return mixed
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * @param mixed $frame
     */
    public function setFrame($frame): void
    {
        $this->frame = $frame;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getGlassGrid()
    {
        return $this->glass_grid;
    }

    /**
     * @param mixed $grid
     */
    public function setGlassGrid($grid): void
    {
        $this->glass_grid = $grid;
    }

    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param mixed $grid
     */
    public function setGrid($grid): void
    {
        $this->grid = $grid;
    }



    public function getMullKit()
    {
        return $this->mull_kit;
    }

    /**
     * @param mixed $mull_kit
     */
    public function setMullKit($mull_kit): void
    {
        $this->mull_kit = $mull_kit;
    }



    /**
     * @return mixed
     */
    public function getGlassoption()
    {
        //return $this->glassoption;
        return $this->glass_option;
    }

    /**
     * @param mixed $glassoption
     */
    public function setGlassoption($glass_option): void
    {
        //$this->glassoption = $glassoption;
        $this->glass_option = $glass_option;
    }

    /**
     * @return mixed
     */
    public function getLowe()
    {
        return $this->lowe;
    }

    /**
     * @param mixed $lowe
     */
    public function setLowe($lowe): void
    {
        $this->lowe = $lowe;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth): void
    {
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * @param mixed $handle
     */
    public function setHandle($handle): void
    {
        $this->handle = $handle;
    }

    /**
     * @return mixed
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * @param mixed $lock
     */
    public function setLock($lock): void
    {
        $this->lock = $lock;
    }

    /**
     * @return mixed
     */
    public function getThickness()
    {
        return $this->thickness;
    }

    /**
     * @param mixed $thickness
     */
    public function setThickness($thickness): void
    {
        $this->thickness = $thickness;
    }


    /**
     * @return frame_thickness
     */
    public function getFrameThicknessOption()
    {
        return $this->frame_thickness_option;
    }
    /**
     * @set frame_thickness
     */
    public function setFrameThicknessOption($frame_thickness_option):void

    {
        $this->frame_thickness_option = $frame_thickness_option;
    }

    /**
     * @return dp_option
     */
    public function getDpOption()
    {
        return $this->dp_option;
    }

    /**
     * @set dp_option
     */
    public function setDpOption($dp_option):void
    {
        $this->dp_option = $dp_option;
    }

    /**
     * @return get lite_option
     */
    public function getliteOption()
    {
        return $this->lite_option;
    }

    /**
     * @return set $lite_option
     */
    public function setliteOption($lite_option):void
    {
        $this->lite_option = $lite_option;
    }


    /**
     * @return set $sill_option
     */
    public function setsillOption($sill_option):void
    {
        $this->sill_option = $sill_option;
    }

    /**
     * @return get lite_option
     */
    public function getsillOption()
    {
        return $this->sill_option;
    }





    /**
     * @return get blind_option
     */
    public function getblindOption()
    {
        return $this->blind_option;
    }

    /**
     * @return set $blind_option
     */
    public function setblindOption($blind_option):void
    {
        $this->blind_option = $blind_option;
    }






    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * @param mixed $spec
     */
    public function setSpec($spec): void
    {
        $this->spec = $spec;
    }

    public function getScreenOption()
    {
        return $this->screen_option;
    }

    /**
     * @param mixed $spec
     */
    public function setScreenOption($screen_option): void
    {
        $this->screen_option = $screen_option;
    }



    public function gethandleColor()
    {
        return $this->handle_color;
    }

    /**
     * @param mixed $spec
     */
    public function sethandleColor($handle_color): void
    {
        $this->handle_color = $handle_color;
    }


    public function getlockColor()
    {
        return $this->lock_color;
    }

    /**
     * @param mixed $spec
     */
    public function setlockColor($lock_color): void
    {
        $this->lock_color = $lock_color;
    }


    public function getsillColor()
    {
        return $this->sill_color;
    }

    /**
     * @param mixed $spec
     */
    public function setsillColor($sill_color): void
    {
        $this->sill_color = $sill_color;
    }



    public function gethingeColor()
    {
        return $this->hing_color;
    }

    /**
     * @param mixed $spec
     */
    public function sethingeColor($hing_color): void
    {
        $this->hing_color = $hing_color;
    }

    public function getassembleOption()
    {
        return $this->assemble_knock;
    }

    /**
     * @param mixed $spec
     */
    public function setassembleOption($assemble_knock): void
    {
        $this->assemble_knock = $assemble_knock;
    }



}
