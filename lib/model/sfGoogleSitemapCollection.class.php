<?php
class sfGoogleSitemapCollection implements Iterator, Countable
{
  protected $items = array(),
            $iterator = 0
            ;
  
  
  public function __construct($items)
  {
    foreach((array) $items as $item)
    {
      $this->add($item);
    }
  }
  
  
  public function add($item)
  {
    if($item instanceof sfGoogleSitemapItem)
    {
      $this->items[$item->getLoc()] = $item;
    }
    elseif($item instanceof sfGoogleSitemapCollection)
    {
      array_merge($this->items, $item);
    }
    elseif(is_string($item))
    {
      $this->items[$item] = new sfGoogleSitemapItem($item);
    }
    return $this;
  }
  
  
  public function remove($item)
  {
    $item_loc = $item;
    if($item instanceof sfGoogleSitemapItem)
    {
      $item_loc = $item->getLoc();
    }
    unset($this->items[$item_loc]);
    return $this;
  }
  
  
  public function toArray()
  {
    return $this->items;
  }
  
  
  public function toIndexedArray()
  {
    return array_values($this->items);
  }
  
  
  /**
   * @param $loc string
   * @return sfGoogleSitemapItem
   */
  public function findByLoc($loc)
  {
    return $this->items[$loc];
  }
  
  /**
   * @param $route_name string
   * @param $route_params array [optional]
   * @param $context sfContext [optional, default = sfContext::getInstance()]
   * @return sfGoogleSitemapItem
   */
  public function findByRoute($route_name, $route_params = array(), sfContext $context = null)
  {
    if(!$context)
    {
      $context = sfContext::getInstance();
    }
    $url = $context->getRouting()->generate($route_name, $route_params, true);
    return $this->findByLoc($url);
  }
  
// SPL
  public function rewind()
  {
    $this->iterator = 0;
  }
  public function current()
  {
    $indexed = $this->toIndexedArray();
    return $indexed[$this->iterator];
  }
  public function key()
  {
    return $this->iterator;
  }
  public function next()
  {
    ++$this->iterator;
  }
  public function valid()
  {
    $indexed = $this->toIndexedArray();
    return isset($indexed[$this->iterator]);
  }
  public function count()
  {
    return count($this->items);
  }
}