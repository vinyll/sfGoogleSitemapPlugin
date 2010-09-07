<?php
class sfGoogleSitemapItem
{
  protected $loc = '',
            $lastmod = '',
            $changefreq = '',
            $priority = 1.0
            ;
  public function __construct($loc)
  {
    $this->setLoc($loc);
  }
  
  public function __toString()
  {
    return $this->getLoc();
  }
  
  public function setLoc($loc)
  {
    $strict_flag = sfConfig::get('app_sf_google_sitemap_strict_mode') ? FILTER_FLAG_SCHEME_REQUIRED : '';
    if(!trim($loc) || !filter_var($loc, FILTER_VALIDATE_URL, $strict_flag))
    {
      throw new sfException(sprintf('"%s" is not a valid Google Sitemap url.', $loc));
    }
    $this->loc = $loc;
    return $this;
  }
  
  
  public function getLoc()
  {
    return $this->loc;
  }
  
  public function setLastmod($lastmod)
  {
    $this->lastmod = $lastmod;
    return $this;
  }
  
  public function getLastmod()
  {
    return $this->lastmod;
  }
  
  public function setChangefreq($changefreq)
  {
    $this->changefreq = $changefreq;
    return $this;
  }
  
  public function getChangefreq()
  {
    return $this->changefreq;
  }
  
  public function setPriority($priority)
  {
    $this->priority = $priority;
    return $this;
  }
  
  public function getPriority()
  {
    return $this->priority;
  }
  
}
