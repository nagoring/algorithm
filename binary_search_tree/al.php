<?php
class Tree{
	private $root;
	private $direction;
	private $value;
	private $cnt = 0;
	private $update_index = 0;
	private $depth = 0;
	public function __construct($value){
		$option = new stdClass();
		$option->index = $this->update_index++;
		$option->parent_direction = 'none';
		$option->depth = $this->depth;
		$this->root = new Node($value,$option); 
		$this->root->left(null);
		$this->root->right(null);
	}
	public function insert($value){
		$this->depth = 1;
		$this->search($this->root, $value);
	}


	public function search(Node $node, $value){
		$this->cnt++;
		if($this->cnt > 100)exit("end");
		if($this->whichIsNull($node)){
			echo "update:$value" . PHP_EOL;
			return $this->updateEitherDirectionNullNode($node, $value);
		}
		if($node->left()->value() < $value){
			$nextNode = $node->left();
		}else{
			$nextNode = $node->right();
		}
		$this->depth++;
		$this->search($nextNode, $value);
	}
	public function whichIsNull($node){
		return $node->left() === null || $node->right() === null;
	}
	public function updateEitherDirectionNullNode($node, $value){
		$option = new stdClass();
		$option->index = $this->update_index++;
		$option->depth = $this->depth;
		if($node->left() === null){
			$option->parent_direction = 'left';
			return $node->left(new Node($value, $option));
		}
		if($node->right() !== null){
			throw new Exception("Either one must be null.");
		}
		if($node->left()->value() <= $value){
			$option->parent_direction = 'right';
			return $node->right(new Node($value, $option));
		}else{
			echo "-------------------------" . PHP_EOL;
			$option->parent_direction = 'left';
			$left = $node->left();
			$node->left(new Node($value, $option));
			return $node->right($left);
		}
	}

	public function each($callback, $node=null){
		$node = $node === null ? $this->root:$node;
		if($node->left()){
			$this->each($callback, $node->left());
		}
		$callback($node);
		if($node->right()){
			$this->each($callback, $node->right());
		}

	}
	public function display(){
		$this->each(function(Node $node){
			echo $node->index . ":" . $node->value() . ' -> ' . $node->depth . '=' . $node->parent_direction . PHP_EOL;
		}, null);
	}
}
class Node{
	public $value;
	public $leftNode;
	public $rightNode;
	public $index;
	public $parent_direction;
	public $depth;

	public function __construct($value, stdClass $option){
		$this->value = $value;
		$this->leftNode = null;
		$this->rightNode = null;
		$this->index = $option->index;
		$this->parent_direction = $option->parent_direction;
		$this->depth = $option->depth;
	}
	public function left(Node $node = null){
		if($node ===  null){
			return $this->leftNode;
		}
		$this->leftNode = $node;
		return $this;
	}
	public function right(Node $node = null){
		if($node ===  null){
			return $this->rightNode;
		}
		$this->rightNode = $node;
		return $this;
	}
	public function value(){
		return $this->value;
	}


}
$tree = new Tree(50);
$tree->insert(9);
$tree->insert(60);
$tree->insert(12);
$tree->insert(5);
$tree->insert(15);
$tree->insert(8);
$tree->insert(2);
$tree->insert(6);
//
$tree->display();



