<?php
    require_once('../0_service/databaseSessionTemplate.php');

    Class ProductsIndatabase{  
        private $pdo;
        private $productQuery;
        private $productParametrs;

        function __construct(){
            $this->pdo = connectToDatabase();

            $this->productQuery = "SELECT products.Id, products.Name, products.Price, products.Description, 
                                          cathegory.Name AS Cathegory, 
                                          type.Name AS Type, 
                                          tax.Value AS Tax, products.SalePercent 
                                   FROM products 
                                   INNER JOIN cathegory ON products.Cathegory = cathegory.Id 
                                   INNER JOIN type ON products.Type = type.Id 
                                   INNER JOIN tax ON products.Tax = tax.Id";

            $this->productParametrs = array();
        }

        function getLastInsertedId(){
            $query = "SELECT LAST_INSERT_ID();";
            $query = $this->pdo->prepare($query);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            return $result['LAST_INSERT_ID()'];
        }

        public function getProduct($id){
            $query = $this->productQuery." WHERE products.Id = :id;";

            $query = $this->pdo->prepare($query);
            $query->execute([
                ':id' => $id
            ]);
            $product = $query->fetch(PDO::FETCH_ASSOC);
            
            return $product;
        }

        private function setCathegory($cathegory){
            if($cathegory != "" && $cathegory != "Wszystkie"){
                $this->productQuery .= " WHERE cathegory.Name = :cath";
                $this->productParametrs[':cath'] = $cathegory;
            }
        }

        private function setPrice($cathegory, $minPrice, $maxPrice){
            if($cathegory == "" || $cathegory == "Wszystkie"){
                $this->productQuery .= " WHERE ";
            }
            else{
                $this->productQuery .= " AND ";
            }

            $this->productQuery .= "products.Price >= :min AND products.Price <= :max";

            $this->productParametrs[':min'] = $minPrice;
            $this->productParametrs[':max'] = $maxPrice;
        }

        private function setFeature($featureValue){
            if($featureValue != ""){
                $this->productQuery .= " AND features.Value = :featureValue";
                $this->productParametrs[':featureValue'] = $featureValue;
            }
        }

        private function setOrderBy($orderBy){
            if($orderBy == 'grow'){
                $this->productQuery .= " ORDER BY products.Price;";
            } else if($orderBy == 'shrink'){
                $this->productQuery .= " ORDER BY products.Price DESC;";
            }
        }

        public function getProductsByCathegoryAndPriceOrderBy($cathegory, $orderBy, $minPrice, $maxPrice, $featureValue){
            if($featureValue != ""){
                $this->productQuery .= " 
                INNER JOIN featurelist ON products.Id = featurelist.ProductId
                INNER JOIN features ON featurelist.FeatureId = features.Id";
            }
            
            $this->setCathegory($cathegory);
            $this->setPrice($cathegory, $minPrice, $maxPrice);
            $this->setFeature($featureValue);
            $this->setOrderBy($orderBy);

            $query = $this->productQuery;
            $parametres = $this->productParametrs;

            $query = $this->pdo->prepare($query);
            $query->execute($parametres);
            
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductsCathegory(){
            $query = "SELECT cathegory.Name FROM cathegory";
            $query = $this->pdo->prepare($query);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getFeatures($id){
            $query = "SELECT features.Name AS Feature, features.Value AS Value
                      FROM featurelist
                      INNER JOIN features ON featurelist.FeatureId = features.Id
                      WHERE featurelist.ProductId = :id;";
                      
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':id' => $id
            ]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $mergedFeatures = [];
            foreach ($result as $row) {
                $mergedFeatures[] = $row['Feature'] . ': ' . $row['Value'];
            }
    
            return $mergedFeatures;
        }

        public function getFeaturesInList(){
            $query = "SELECT features.Name AS Feature, features.Value AS Value
                      FROM features;";
            $query = $this->pdo->prepare($query);
            $query->execute();

            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getProductByName($name){
            $query = "SELECT products.Name FROM products WHERE products.Name = :name";
            $query = $this->pdo->prepare($query);
            $query->execute([
                ':name' => $name
            ]);

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function addProductToDatabase($name, $description, $price, $category, $type, $tax){
            $query = "INSERT INTO products (`Name`, `Description`, `Price`, `Cathegory`, `Type`, `Tax`) 
              VALUES (:name, :description, :price, :category, :type, :tax)";

            $query = $this->pdo->prepare($query);
            $query->execute([
                ':name' => $name,
                'description' => $description,
                ':price' => $price,
                ':category' => $category,
                ':type' => $type,
                ':tax' => $tax
            ]);

            return $this->getLastInsertedId();
        }
    }    
?>