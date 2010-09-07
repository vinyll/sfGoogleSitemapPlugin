<?php
class BasesfGoogleSitemapActions extends sfActions
{
  public function executeSitemap(sfWebRequest $request)
  {
    $this->items = array();
  }
  
}