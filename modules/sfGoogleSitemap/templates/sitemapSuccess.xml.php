<?php echo '<?xml version="1.0" encoding="utf-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach($items as $item): ?>
  <url>
    <?php if($item->getLoc()): ?>
    <loc><?php echo $item->getLoc() ?></loc>
    <?php endif ?>
    <?php if($item->getLastmod()): ?>
    <lastmod><?php echo $item->getLastmod() ?></lastmod>
    <?php endif ?>
    <?php if($item->getChangefreq()): ?>
    <changefreq><?php echo $item->getChangefreq() ?></changefreq>
    <?php endif ?>
    <?php if($item->getPriority()): ?>
    <priority><?php echo $item->getPriority() ?></priority>
    <?php endif ?>
  </url>
  <?php endforeach ?>
</urlset>