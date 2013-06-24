<div id="category-listing">
	<h1><?php echo $page_title;?></h1>
	<div id="right"><a class="add button blue" href="#">Add Category<span></span></a></div>

	<?php 
/**
 * Getting nested set model into a <ul> but hiding “closed” subtrees
 * 
 * @link http://stackoverflow.com/a/7786733/367456
 */

// $categories = get_categories();
		
$current = array('lft' => '2', 'rgt' => '11');

$start = microtime(TRUE);

$sequence = new SequenceTreeIterator($category);

echo '<ul><!-- start -->', "\n";
$hasChildren = FALSE;
foreach($sequence as $node)
{
	if ($close = $sequence->getCloseLevels())
	{
		echo str_repeat('</ul></li>', $close), "\n";
		$hasChildren = FALSE;
	}
	if (!$node && $hasChildren)
	{
		echo '</li>', "\n";
	}
	if (!$node) break; # terminator
	
	$hasChildren = $node->hasChildren();
	$childCount = $node->childCount();
	$isSelected = $node->isSupersetOf($current);

	$classes = array('item');
	$isSelected && ($classes[] = 'selected') && $hasChildren && $classes[] = 'open';
	$node->isSame($current) && $classes[] = 'current';
	
	$label = sprintf('%s (%d/%d)', $node['name'], $hasChildren, $childCount);
	if($hasChildren) {
	printf('<li class="heading %s" style="background:url(images/portal/arrow_plus.png) no-repeat left 20px"><div class="left">%s</div><div class="right">' . form_hidden('id', $node['category_id']) . '<span><a class="edit" href="#">Edit</a> | <a class="delete" href="#">Delete</a></span></div><div class="clear"></div>', implode(' ', $classes), $label);
	
	} else {
	printf('<li class="%s"><div class="left">%s</div><div class="right">' . form_hidden('id', $node['category_id']) . '<span><a class="edit" href="#">Edit</a> | <a class="delete" href="#">Delete</a></span></div><div class="clear"></div>', implode(' ', $classes), $label);
	}

	if ($hasChildren) {
		echo '<li class="content" style="border-bottom:none;">';
		if ($isSelected){
			echo "\n", '<ul>';}
		else{
			$sequence->skipChildren();}
			
	}
	else{
		echo '</li>', "\n";
	}
}
echo '</ul>';

echo "\n", microtime(TRUE) - $start, "\n";

class SequenceTreeIterator extends ArrayIterator
{
	private $keyDepth = 'depth';
	private $skipDepth;
	private $depth;
	private $prevDepth;
	private $index;
	
	public function __construct(array $array)
	{
		parent::__construct($array);
		parent::append(NULL); // add terminator
	}
	
	public function rewind()
	{
		$this->skipDepth = FALSE;
		$this->terminate = FALSE;
		$this->prevDepth = 0;
		$this->index = 0;
		parent::rewind();
	}
	public function current()
	{
		$current = parent::current();
		if ($current)
		{
			$current = new Node($current);
			$this->depth = $current[$this->keyDepth];
		}
		else
		{
			$this->depth = 0;
		}
		return $current;
	}
	public function next()
	{
		$current = parent::current();
		$prevDepth = (int) $current[$this->keyDepth];
		assert('$prevDepth>=0');
		$this->prevDepth = $prevDepth;

		$skipDepth = $this->skipDepth;
		$this->skipDepth = FALSE;

		do
		{
			$this->index++;
			parent::next();
			
			if (NULL === $next = parent::current())
				break;

			$nextDepth = $next[$this->keyDepth];
		}
		while(FALSE !== $skipDepth && $nextDepth > $skipDepth);
	}
	public function skipChildren()
	{
		$this->skipDepth = $this->depth;
	}
	public function getPrevDepth()
	{
		return $this->prevDepth;
	}
	public function getDepth()
	{
		return $this->depth;
	}
	public function getCloseLevels()
	{
		return max(0, $this->prevDepth - $this->depth);
	}
	public function getIndex()
	{
		return $this->index;
	}
	public function hasNext()
	{
		return ($this->index+1) < count($this);
	}
}

class Node extends ArrayObject
{
	public function __construct(array $node)
	{
		if (!isset($node['name'])) $node['name'] = '(unnamed)';
		parent::__construct($node);
	}
	public function getLeftRight()
	{
		return array($this['lft'], $this['rgt']);
	}
	public function childCount()
	{
		list($left, $right) = $this->getLeftRight();
		$count = $right - $left - 1;
		assert('$count > -1');
		return $count >> 1;
	}
	public function hasChildren()
	{
		return (bool) $this->childCount();
	}
	private function compare($node, $mode)
	{
		if (is_array($node))
			$node = new self($node);
			
		list($left, $right) = $this->getLeftRight();
		list($nodeLeft, $nodeRight) = $node->getLeftRight();
		
		switch($mode)
		{
			case '<==>':
				return $left <= $nodeLeft && $right >= $nodeRight;

			case '<>':
				return $left < $nodeLeft && $right > $nodeRight;

			case '==':
				return $left == $nodeLeft && $right == $nodeRight;

			case '><':
				return $left > $nodeLeft && $right < $nodeRight;

			default:
				throw new InvalidArgumentException(sprintf('Invalid mode "%s".', $mode));
		}
	}
	public function isParentOf($node)
	{
		return $this->compare($node, '<>');   
	}
	public function isSupersetOf($node)
	{
		return $this->compare($node, '<==>');
	}
	public function isSame($node)
	{
		return $this->compare($node, '==');
	}
	public function isChildOf($node)
	{
		return $this->compare($node, '><');
	}
}

// $current = array('lft' => '5', 'rgt' => '6');
// print MyRenderTree1($categories, $current);
?>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script>
	var category = <?php echo json_encode($category); ?>;

	$(document).ready(function() {
  		$(".content").hide();
		  //toggle the componenet with class msg_body
		  $(".heading").click(function()
		  {
		  	$(this).toggleClass("show");
		    $(this).next(".content").slideToggle(500);
		    // $(this).css("background","url(images/portal/arrow_plus.png) no-repeat left 20px")
		  });
	});
</script>