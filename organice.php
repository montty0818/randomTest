function organic($tree, $target_val)
{
  if (!isset($tree['children'])) { return array ('val' => 1,); }
  $childrens = $tree['children'];
  $copyChildrens = [];
  $match = false;
  $holder = [];
  for ($i =0; $i < count($childrens); $i++) {
    array_walk_recursive($childrens[$i], function($value, $key) use (&$match, $target_val) {
      if ($value == $target_val) {
        $match = true;
      }
    }, $match);
    if ($match) {
      $match = false;
      if (isset($childrens[$i]['children'])) {
        $holder[] = organic($childrens[$i], $target_val);
      } else {
        $holder[] = $childrens[$i];        
      }
    } else {
      $copyChildrens[] = $childrens[$i];
    }
  }
  $newChildren = array_merge($holder, $copyChildrens);
  $tree['children'] = $newChildren;
  return $tree;
}
 