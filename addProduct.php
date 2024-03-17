<?php

require_once("connectdb.php");

//$stat = $db->prepare('INSERT INTO `product` (`productid`, `productTypeid`, `stock`, `colour`, `size`, `imageFilePath`) VALUES (NULL, ?, ?, ?, ?, ?)');
            $productid = 5;
            $stock = 50;
            $colour = 'Yellow';
            $imgFilePath = './images/Coat5Yellow.png';
			  $stat->execute(array($productid, $stock, $colour, "XS", $imgFilePath));
              $stat->execute(array($productid, $stock, $colour, "S", $imgFilePath));
              $stat->execute(array($productid, $stock, $colour, "M", $imgFilePath));
              $stat->execute(array($productid, $stock, $colour, "L", $imgFilePath));
              $stat->execute(array($productid, $stock, $colour, "XL", $imgFilePath));

