<?php
class Tree{
	private $root;
	private $direction;
	private $value;
	public function __constract($value){
		$this->root = new Node($value);
		$this->root->setLeftNode(null);
		$this->root->setRightNode(null);
	}
	public function insert($value){
		$node = new Node($value);
		if($this->root->left === null){
			$this->root->left($node);
		}
		else if($$this->root->right === null){
			$this->root->right($node);
		}
	}
	public function find(){
	}
}
class Node{
	public $value;
	public $leftNode;
	public $rightNode;
	public $parentNode;

	public function __constract($value){
		$this->$value;
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





