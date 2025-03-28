<?php

namespace App\Http\Controllers\Product;

use App\Models\Order\DoorItem;
use App\Models\Product\Door\DoorViewObject;

class ProductUtility
{
    public function getViewItem(DoorItem $cartItem): DoorViewObject
    {
        $viewObject     = new DoorViewObject();
        $basePrice      = 0;
        $gridPrice      = 0;
        $gridMultiplier = 0;
        $handlePrice    = 0;
        $lockPrice      = 0;

        $viewObject->setId($cartItem->id);
        $viewObject->setCategoryName($cartItem->category_name);
        $viewObject->setQuantity($cartItem->quantity);
        $viewObject->setName($cartItem->door_name);
        $viewObject->setDoorTypeName($cartItem->door_type_pretty_name);

        $viewObject->setassembleOption($cartItem->assemble_knock);


        foreach ($cartItem->doorItemModifiers as $modifier) {
            switch ($modifier->door_modifier_key) {
                case 'SPEC':
                    $viewObject->setSpec($modifier->door_modifier_value);
                    break;
                case 'SIZE':
                    $viewObject->setSize($modifier->door_modifier_value);
                    break;
                case 'COLOR':
                    $viewObject->setColor($modifier->door_modifier_value);
                    break;
                case 'HANDLING':
                    $viewObject->setHandling($modifier->door_modifier_value);
                    break;
                case 'GLASS_GRID':
                    //$viewObject->setGrid($modifier->door_modifier_value);
                    $viewObject->setGlassGrid($modifier->door_modifier_value);
                    //$viewObject->setGlassoption($modifier->door_modifier_value);
                    break;
                case 'GLASS_DEPTH':
                    $viewObject->setDepth($modifier->door_modifier_value);
                    break;
                case 'GLASS_OPTION':
                    //$viewObject->setGlassoption($modifier->door_modifier_value);
                    $viewObject->setGlassoption($modifier->door_modifier_value);
                    break;
                case 'LOWE':
                    $viewObject->setLowe($modifier->door_modifier_value);
                    break;
//                case 'THIC':
//                    $viewObject->setThickness($modifier->door_modifier_value);
                    break;
                case 'NOTES':
                    $viewObject->setNotes($modifier->door_modifier_value);
                    break;
                case 'LOCK':
                    $viewObject->setLock($modifier->door_modifier_value);
                    break;
                case 'FRAME':
                    $viewObject->setFrame($modifier->door_modifier_value);
                    break;
                case 'HANDLE':
                    $viewObject->setHandle($modifier->door_modifier_value);
                    break;


                case 'FRAME_THICKNESS_OPTION':
                    $viewObject->setFrameThicknessOption($modifier->door_modifier_value);
                    break;
                case 'DP_OPTION':
                    $viewObject->setDpOption($modifier->door_modifier_value);
                    break;

                case 'BLIND_OPTION':
                    $viewObject->setblindOption($modifier->door_modifier_value);
                    break;

                case 'SILL_OPTION':
                    $viewObject->setsillOption($modifier->door_modifier_value);
                    break;

                case 'LITE_OPTION':
                    $viewObject->setliteOption($modifier->door_modifier_value);
                    break;

                case 'HINGE_COLOR_OPTION':
                    $viewObject->sethingeColor($modifier->door_modifier_value);
                    break;

                case 'LOCK_COLOR_OPTION':
                    $viewObject->setlockColor($modifier->door_modifier_value);
                    break;

                case 'SILL_COLOR_OPTION':
                    $viewObject->setsillColor($modifier->door_modifier_value);
                    break;

                case 'HANDLE_COLOR_OPTION':
                    $viewObject->sethandleColor($modifier->door_modifier_value);
                    break;

//                case 'ASSEMBLE_OPTION':
//                    $viewObject->setassembleOption($modifier->door_modifier_value);
//                    break;

                case 'SCREEN_OPTION':
                    $viewObject->setScreenOption($modifier->door_modifier_value);
                    break;
                case 'MULL_KIT':
                    $viewObject->setMullKit($modifier->door_modifier_value);
                    break;

            }
        }

        //$viewObject->setPrice(money_format('%.2n', $cartItem->price));
        $viewObject->setPrice(sprintf('%01.2f', $cartItem->price));
//        {{sprintf('%01.2f', $or->total)}}

        return $viewObject;
    }
    public function getViewItem_BKK(DoorItem $cartItem): DoorViewObject
    {
        $viewObject = new DoorViewObject();
        $basePrice = 0;
        $gridPrice = 0;
        $gridMultiplier = 0;
        $handlePrice = 0;
        $lockPrice = 0;

        $viewObject->setId($cartItem->id);
        $viewObject->setCategoryName($cartItem->category_name);
        $viewObject->setQuantity($cartItem->quantity);
        $viewObject->setName($cartItem->door_name);
        $viewObject->setDoorTypeName($cartItem->door_type_pretty_name);
        foreach ($cartItem->doorItemModifiers as $modifier) {
            switch ($modifier->door_modifier_key) {
                case 'SPEC':
                    $viewObject->setSpec($modifier->door_modifier_value);
                    break;
                case 'SIZE':
                    $viewObject->setSize($modifier->door_modifier_value);
                    break;
                case 'COLOR':
                    $viewObject->setColor($modifier->door_modifier_value);
                    break;
                case 'HANDLING':
                    $viewObject->setHandling($modifier->door_modifier_value);
                    break;
                case 'GLASS_GRID':
                    $viewObject->setGrid($modifier->door_modifier_value);
                    break;
                case 'GLASS_DEPTH':
                    $viewObject->setDepth($modifier->door_modifier_value);
                    break;
                case 'GLASS_OPTION':
                    $viewObject->setGlassoption($modifier->door_modifier_value);
                    break;
                case 'LOWE':
                    $viewObject->setLowe($modifier->door_modifier_value);
                    break;
                case 'THIC':
                    $viewObject->setThickness($modifier->door_modifier_value);
                    break;
                case 'NOTES':
                    $viewObject->setNotes($modifier->door_modifier_value);
                    break;
                case 'LOCK':
                    $viewObject->setLock($modifier->door_modifier_value);
                    break;
                case 'FRAME':
                    $viewObject->setFrame($modifier->door_modifier_value);
                    break;
                case 'HANDLE':
                    $viewObject->setHandle($modifier->door_modifier_value);
                    break;
                case 'SCREEN_OPTION':
                    $viewObject->setScreenOption($modifier->door_modifier_value);
                    break;
            }
        }

        //$viewObject->setPrice(money_format('%.2n', $cartItem->price));
        $viewObject->setPrice(sprintf('%01.2f', $cartItem->price));
//        {{sprintf('%01.2f', $or->total)}}

        return $viewObject;
    }
}
