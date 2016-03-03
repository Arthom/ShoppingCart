<?php
	/**
	* Project: Shopping Cart
	* Version: 1.0
	* File: Cart.class.php
	* Author: Matej Gleza (matejgleza@gmail.com)
	* URL: http://arthom.eu
	* Note: Simple Shopping Cart
	* License: GPL v3.0
	* Last update: 02 Mar 2016
	*/

	class CartItem {
		public $_itemID;
		public $_itemData;
		public function __construct($itemID, $itemData) {
			$this->_itemID = (int) $itemID;
			$this->_itemData = $itemData;
		}
	}

	class Cart {
		private static $_instance;
		private $_Cart = array();
		private $_CookieLifeTime = 86400;
		public function __construct() {
			$this->_Cart = (!empty($_COOKIE['Cart']) ? $_COOKIE['Cart'] : '');
			$this->_Cart = json_decode($this->_Cart, true);
		}

		public function addItems($itemID, $itemData = null, $count = 1) {
			if ((int) $count <= 0)
				return;
			if (isset($this->_Cart[$itemID]))
				$this->_Cart[$itemID]['Count'] += $count;
			else {
				$this->_Cart[$itemID]['Count'] = $count;
				$this->_Cart[$itemID]['Data'] = new CartItem($itemID, $itemData);
			}
			$this->_cartUpdate();
		}

		public function removeItems($itemID, $count) {
			if ((int) $count <= 0)
				return;
			if (isset($this->_Cart[$itemID])) {
				if ($this->_Cart[$itemID]['Count'] > $count)
					$this->_Cart[$itemID]['Count'] -= $count;
				else
					unset($this->_Cart[$itemID]);
			}
			$this->_cartUpdate();
		}

		public function emptyCart() {
			unset($this->_Cart);
			$this->_cartUpdate();
		}

		public function getItemsData($itemID) {
			return $this->_Cart[$itemID]['Data'];
		}

		public function getItemsCount($itemID) {
			return $this->_Cart[$itemID]['Count'];
		}

		public function getAllItemsCount() {
			$totalCount = 0;
			foreach ($this->_Cart as $data) {
				$totalCount += $data['Count'];
			}
			return (int) $totalCount;
		}

		public function __destruct() {
			$this->_cartUpdate();
		}

		private function _cartUpdate() {
			setcookie('Cart', json_encode($this->_Cart), time() + $this->_CookieLifeTime);
		}
	}
?>