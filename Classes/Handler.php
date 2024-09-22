<?php

    class Handler
    {
        
        public function __construct($con)
        {
            if(isset($_POST['TAG']) and !empty($_POST['TAG']) )
            {
                
                $TAG = $_POST['TAG'];
                
                if(!method_exists($this, $_POST['TAG']))
                {   $TAG="Default";     }
                
                $this->$TAG($con, $_POST);

            }
        }

        public function Default()
        {
            echo "You may lost the path!";
        }

        public function getProduct($con, $POST)
        {
            // Get SKU, Name and Price from Database
            $selProd = "SELECT product_id, product_sku, product_name, product_price FROM product_master WHERE product_status = :prod_status "; // SELECT Products Data
            $stmProd = $con->prepare($selProd); // Prepare Query
            $stmProd->execute([":prod_status"=>"on"]); // Assign Parameter and Execute
            $resProd = $stmProd->fetchAll(PDO::FETCH_ASSOC); // Fetch Data as Associative Array
            echo json_encode($resProd); // return Array
        }

        public function addOrder($con, $POST)
        {
            $prod_id = $POST['pid'];
            $width = $POST['width'];
            $height = $POST['height'];

            // Insert into the database
            $stmt = $con->prepare("INSERT INTO order_master (session_id, product_id, width, height, quantity)
                                VALUES (:session_id, :product_id, :width, :height, 1 )");
            $stmt->execute([
                ':session_id' => $_SESSION['session_id'],
                ':product_id' => $prod_id,
                ':width' => $width,
                ':height' => $height
            ]);
            
            echo $con->lastInsertId();
        }

        public function deleteOrder($con, $POST)
        {
            $order_id = $POST['order_id'];
            $stmt = $con->prepare("UPDATE order_master SET order_status = 'off' WHERE order_id = :order_id AND session_id = :session_id");
            $stmt->execute([
                ':order_id' => $order_id,
                ':session_id' => $_SESSION['session_id']
            ]);

            echo $stmt->rowCount();
        }

        public function updateQty($con, $POST)
        {
            $order_id = $POST['order_id'];
            $quantity = $POST['quantity'];

            if($quantity > 0)
            {
                // Update the order in the database
                $stmt = $con->prepare("UPDATE order_master SET quantity = :quantity WHERE order_id = :order_id AND session_id = :session_id");
                $stmt->execute([
                    ':quantity' => $quantity,
                    ':order_id' => $order_id,
                    ':session_id' => $_SESSION['session_id']
                ]);

                echo $stmt->rowCount();
            }
            else
            {
                echo 0;
            }
        }

        public function getOrderList($con) {

            $stmt = $con->prepare("SELECT P.product_sku, P.product_name, P.product_price, O.* FROM order_master O LEFT JOIN product_master P ON O.product_id = P.product_id WHERE O.session_id = :session_id AND order_status='on' ");
            $stmt->execute([':session_id' => $_SESSION['session_id']]);
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode($orders);

        }

    }