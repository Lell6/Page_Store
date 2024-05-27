<?php    
    require_once("../0_service/products.php");
    require_once("../0_service/databaseSessionTemplate.php");
    $serviceProductControl = new ProductsIndatabase();

    Class Product{
        private $pdo;
        private $product;
        private $fetures;
        private $id;
        private $serviceProductControl;

        function __construct(){
            $this->id = $_GET['id'];
            $this->serviceProductControl = new ProductsIndatabase();
            $this->product = $this->serviceProductControl->getProduct($this->id);
            $this->features = $this->serviceProductControl->getFeatures($this->id);
        }

        function printProduct(){
            $template = setTemplate("templates/page_product.twig");
        
            if($this->product !== null){
                $this->product['Price'] = number_format($this->product['Price']/100,2);
                $link = htmlspecialchars($_SERVER['REQUEST_URI']);
            
                $images_path = 'images/products_images/' . $this->product['Id'];
                $image_list = [];
                
                foreach(scandir($images_path) as $image){
                    if(strstr($image, "small")){
                        array_push($image_list, $images_path . "/" . $image);
                    }
                }
    
                echo $template->render(['product' => $this->product, 'images' => $image_list, 'link' => $link, 'features' => $this->features]);
            }
        }
    
        function printProductTitle(){
            $template = setTemplate('templates/elementPage_productTitle.twig');
            
            if($this->product !== null){
                echo $template->render(['name' => $this->product['Name']]);
            }
        }    
    }

    $productClass = new Product();
?>