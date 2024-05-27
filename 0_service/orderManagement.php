<?php
    require_once("../0_service/databaseSessionTemplate.php");
    requireSession();

    Class Order{
        private $pdo;
        public $orderId;

        function __construct(){
            $this->pdo = connectToDatabase();
        }

        function getLastInsertedId(){
            $query = "SELECT LAST_INSERT_ID();";
            $query = $this->pdo->prepare($query);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['LAST_INSERT_ID()'];
        }

        public function getProductListInOrder($orderId){
            $query = "SELECT faktura.Id from faktura WHERE OrderId = :id";
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':id' => $orderId
            ]);

            $fakturaId = $query->fetch(PDO::FETCH_ASSOC);

            if($fakturaId){
                $query = "SELECT * FROM productlist WHERE FakturaId = :id";
                $query = $this->pdo->prepare($query);
                $query->execute([
                    ':id' => $fakturaId['Id']
                ]);
    
                $result = $query->fetchALL(PDO::FETCH_ASSOC);
                return $result;
            }
            else{
                return null;
            }
        }

        public function getExecutedOrderById($orderId){
            $query = "SELECT orders.Id, orders.CustomerName, orders.CustomerSurname, orders.PhoneNumber, orders.Email, 
                             orders.City, orders.Street, orders.HouseNumber, orders.ApartmentNumber, 
                             orders.WholePrice, orders.ProductsPrice, orders.DeliveryPrice,
                             paymenttype.Name AS Payment,
                             shipmenttype.Name AS Shipment,
                             orders.DateOfSubmission, orders.Commentary
                      FROM orders
                      INNER JOIN paymenttype ON orders.Payment = paymenttype.Id
                      INNER JOIN shipmenttype ON orders.Shipment = shipmenttype.Id
                      WHERE orders.Id = :id;";
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':id' => $orderId
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function getAllOrders(){
            $query = "SELECT orders.Id, orders.CustomerName, orders.CustomerSurname, orders.PhoneNumber, orders.Email, 
                             orders.City, orders.Street, orders.HouseNumber, orders.ApartmentNumber, 
                             orders.WholePrice, orders.ProductsPrice, orders.DeliveryPrice,
                             paymenttype.Name AS Payment,
                             shipmenttype.Name AS Shipment,
                             orderstatus.Name AS Status,
                             orders.DateOfSubmission, orders.Commentary
                      FROM orders
                      INNER JOIN paymenttype ON orders.Payment = paymenttype.Id
                      INNER JOIN shipmenttype ON orders.Shipment = shipmenttype.Id
                      INNER JOIN orderstatus ON orders.OrderStatus = orderstatus.Id;";
            $query = $this->pdo->prepare($query);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function setNewOrder($inputedData, $orderData){
            $query = "INSERT INTO orders (CustomerName, CustomerSurname, PhoneNumber,Email,
                                          City,Street,HouseNumber,ApartmentNumber,
                                          WholePrice, ProductsPrice, DeliveryPrice,
                                          Payment,Shipment,Commentary) 
                             VALUES (:name, :surname, :number, :email, 
                                     :city, :street, :house, :apartment, 
                                     :price, :productPrice, :deliveryPrice, 
                                     :payment, :shipment, :commentary);";

            $query = $this->pdo->prepare($query);
            $query->execute([
                ':name' => $inputedData['CustomerName'],
                ':surname' => $inputedData['CustomerSurname'],
                ':number' => $inputedData['PhoneNumber'],
                ':email' => $inputedData['Email'],
                ':city' => $inputedData['City'],
                ':street' => $inputedData['Street'],
                ':house' => $inputedData['HouseNumber'],
                ':apartment' => $inputedData['ApartmentNumber'],
                ':price' => $orderData['prices'][2],
                ':productPrice' => $orderData['prices'][0],
                ':deliveryPrice' => $orderData['prices'][1],
                ':payment' => $inputedData['Payment'],
                ':shipment' => $inputedData['Shipment'],
                ':commentary' => $inputedData['Commentary']
            ]);

            $this->orderId = $this->getLastInsertedId();
            return $this->orderId;
        }

        public function updateOrder($orderId){
            $query = "UPDATE orders 
                      SET OrderStatus = :status 
                      WHERE orders.Id = :orderId;";
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':status' => 4,
                ':orderId' => $orderId
            ]);
        }

        public function cancelOrder($orderId){
            $query = "UPDATE orders 
                      SET OrderStatus = :status 
                      WHERE orders.Id = :orderId;";
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':status' => 7,
                ':orderId' => $orderId
            ]);
        }
    }
?>