<?php

namespace App;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $shipTotalPrice = 0;

    public function __construct($oldCart){

    	if($oldCart){
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    		$this->shipTotalPrice = $oldCart->shipTotalPrice;
    	}
    }

    public function add($item, $id){
           foreach($item->image as $image)

    	  $storedItem = ['id'=>$item->id,'qty'=>0, 'price'=>$item->price,'image'=>$image->image_path,'item'=>$item];
    	   if($this->items){
    	   	if(array_key_exists($id, $this->items)){
    	   		$storedItem = $this->items[$id];
    	   	}
    	   }


           $storedItem['qty']++;
           $storedItem['price']= $item->price* $storedItem['qty'];
    	   $this->items[$id] = $storedItem;
    	   $this->totalQty++;
    	   $this->totalPrice += $item->price;
           if($this->totalPrice<500){
            $this->shipTotalPrice = $this->totalPrice+50;
           }else{
            $this->shipTotalPrice= $this->totalPrice;
           }

    }
    public function reduceByOne($id){

           $this->items[$id]['qty']--;
           $this->items[$id]['price'] -= $this->items[$id]['item']['price'];


    	   $this->totalPrice -= $this->items[$id]['item']['price'];
             if($this->totalPrice<500){
            $this->shipTotalPrice = $this->totalPrice+50;
           }else{
            $this->shipTotalPrice= $this->totalPrice;
           }
    	   if($this->items[$id]['qty']<=0){
           $this->totalQty--;
    	   	unset($this->items[$id]);
    	   }

    }
    public function addByOne($id){

           $this->items[$id]['qty']++;
           $this->items[$id]['price'] += $this->items[$id]['item']['price'];
    	   $this->totalQty;
    	   $this->totalPrice += $this->items[$id]['item']['price'];

          if($this->totalPrice<500){
            $this->shipTotalPrice = $this->totalPrice+50;
           }else{
            $this->shipTotalPrice= $this->totalPrice;
           }
    }
     public function removeItem($id){
     	$this->totalQty -= $this->items[$id]['qty'];
         $this->shipTotalPrice -=$this->totalPrice;
     	$this->totalPrice -= $this->items[$id]['price'];
        if($this->totalPrice<500){
            $this->shipTotalPrice = $this->totalPrice+50;
           }else{
            $this->shipTotalPrice= $this->totalPrice;
           }
     	unset($this->items[$id]);
     }





}
