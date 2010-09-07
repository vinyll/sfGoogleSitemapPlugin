<?php

require dirname(__FILE__).'/../bootstrap/unit.php';
require dirname(__FILE__).'/../../lib/model/sfGoogleSitemapItem.class.php';
require dirname(__FILE__).'/../../lib/model/sfGoogleSitemapCollection.class.php';

$t = new lime_test(10, new lime_output_color());
$c = new sfGoogleSitemapCollection(array('http://google.com', 'http://yahoo.com'));

$items = array_values($c->toArray());

$t->ok($items[0] instanceof sfGoogleSitemapItem, 'Collection constructor converts strings parameters to sfGoogleSitemapItem\'s.');

$t->is(count($c), 2, 'constructor take an array of strings as argument');
$t->is(count(new sfGoogleSitemapCollection(array(new sfGoogleSitemapItem('http://google.com'), new sfGoogleSitemapItem('http://yahoo.com')))), 2, 'constructor take an array of sfGoogleSitemapItem\'s as argument');

$t->is(count($c->add('http://particul.es')), 3, '$collection->add() adds a string url');
$t->is(count($c->remove('http://particul.es')), 2, '$collection->remove() removes a string url');
$t->is(count($c->add(new sfGoogleSitemapItem('http://particul.es'))), 3, '$collection->add() adds a sfGoogleSitempaItem');
$t->is(count($c->remove(new sfGoogleSitemapItem('http://particul.es'))), 2, '$collection->remove() removes a sfGoogleSitempaItem');

try
{
  $c->add('This is not a url');
  $t->fail('$collection->add() checks for valid urls');
}
catch(sfException $e)
{
  $t->pass('$collection->add() checks for valid urls');
}

$t->diag('Collection searching');
$t->is($c->findByLoc('http://google.com'), $items[0], '$collection->findByLoc() retrieves an item by its url');

$t->diag('SPL Iterator');
$items = array();foreach($c as $item) $items[] = $item;
$t->is(count($items), 2, 'Collection can be iterated with foreach');
