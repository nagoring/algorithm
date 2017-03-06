<?php
class Tree{
	private $root;
	private $direction;
	private $value;
	private $cnt = 0;
	public function __construct($value){
		$this->root = new Node($value);
		$this->root->left(null);
		$this->root->right(null);
	}
	public function insert($value){
		$this->search($this->root, $value);
	}


	public function flow(){
		$node = $this->root;
	}
	public function search(Node $node, $value){
		$this->cnt++;
		if($this->cnt > 5)exit("end");
		echo "search:$value" . PHP_EOL;
		echo "node->value:" . $node->value() . PHP_EOL;
		if($this->whichIsNull($node)){
			echo "update:$value" . PHP_EOL;
			return $this->updateEitherDirectionNullNode($node, $value);
		}
//		var_dump($node->left());
		if($node->left()->value() < $value){
			$nextNode = $node->left();
		}else{
			$nextNode = $node->right();
		}
//		var_dump($value);
//		var_dump($nextNode);
//		var_dump($nextNode->left());
//		var_dump($nextNode->right());
		echo "before search" . PHP_EOL;
		$this->search($nextNode, $value);
	}
	public function whichIsNull($node){
		return $node->left() === null || $node->right() === null;
	}
	public function updateEitherDirectionNullNode($node, $value){
		$newNode = new Node($value);
		if($node->left() === null){
			echo "left -> ";
			//var_dump($newNode);
			return $node->left($newNode);
		}
		if($node->right() !== null){
			throw new Exception("Either one must be null.");
		}
		if($node->left()->value() <= $value){
			echo "right -> ";
			//var_dump($newNode);
			return $node->right($newNode);
		}else{
			echo "-------------------------" . PHP_EOL;
			$left = $node->left();
			$node->left($newNode);
			return $node->right($left);
		}
	}

	public function find(){
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
			echo "" . $node->value() . PHP_EOL;
		}, null);
	}
}
class Node{
	public $value;
	public $leftNode;
	public $rightNode;

	public function __construct($value){
		$this->value = $value;
		$this->leftNode = null;
		$this->rightNode = null;
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
//$tree->insert(5);
//$tree->insert(15);
//$tree->insert(8);
//$tree->insert(2);
//$tree->insert(6);
//
$tree->display();



