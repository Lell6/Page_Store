<?php
    Class ImageControl{
        private $productId;

        private $imageFolderPath;
        private $imageList;

        private $tempImage;
        private $imageName;

        private $ratio;

        public function getImages($list, $productId){
            $this->imageList = $list;
            $this->productId = $productId;

            $this->createFolderForImages();
        }

        function createFolderForImages(){
            $dir = "../mainStore/images/products_images/".$this->productId;
    
            if(!file_exists($dir)){
                if (!mkdir($dir, 0777, true)) {
                    die('Failed to create directory');
                    exit();
                }
            }
            
            $this->imageFolderPath = $dir;
        }

        function deleteFolderForImages($dir){
            if (!file_exists($dir)) {
                return true;
            }
        
            if (!is_dir($dir)) {
                return unlink($dir);
            }
        
            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }
        
                if (!$this->deleteFolderForImages($dir . DIRECTORY_SEPARATOR . $item)) {
                    return false;
                }    
            }
        
            return rmdir($dir);
        }

        public function removeImagesInFolder($productId){
            $imageFolderPath = "../mainStore/images/products_images/".$productId;

            foreach (scandir($imageFolderPath) as $image) {
                if ($image == '.' || $image == '..') {
                    continue;
                }
                unlink($imageFolderPath."/".$image);
            }
        }

        public function iterateThroughImagesAndAdd(){
            $i = 1;
            foreach ($this->imageList['files']['tmp_name'] as $key => $tmpName) {
                if ($this->imageList['files']['error'][$key] === UPLOAD_ERR_OK) {
                    $this->tempImage = $tmpName;
                    
                    $file_extension = pathinfo($this->imageList['files']['name'][$key], PATHINFO_EXTENSION);
                    $this->imageName = $i . '.' . $file_extension;
                    
                    $this->addImageForProduct($i);
                    $i++;
                }
            }
        }

        function addWebpImageForProduct($image, $imagePath){
            imagepalettetotruecolor($image);
            imagewebp($image, $imagePath, 80);
            imagedestroy($image);
        }
        
        function addImageForProduct($i){
            $pathInDir = $this->imageFolderPath . "/" . $this->imageName;
        
            if (move_uploaded_file($this->tempImage, $pathInDir)) {
                $image = imagecreatefromstring(file_get_contents($pathInDir));
        
                if ($image !== false) {
                    $originalImagePath = $this->imageFolderPath . "/" . $i . ".webp";
                    $this->ratio = $this->getImageRatio($pathInDir);
        
                    $height = 300;
                    $image_medium = $this->scaleImageByHeightAndRatio($image, $height);
                    $imagePathMedium = $this->imageFolderPath . "/" . $i . "_medium.webp";
        
                    $height = 50;
                    $image_small = $this->scaleImageByHeightAndRatio($image, $height);
                    $imagePathSmall = $this->imageFolderPath . "/" . $i . "_small.webp";
        
                    $this->addWebpImageForProduct($image, $originalImagePath);
                    $this->addWebpImageForProduct($image_medium, $imagePathMedium);
                    $this->addWebpImageForProduct($image_small, $imagePathSmall);
                }
            }
        }  

        function getImageRatio($pathInDir){
            $size = getimagesize($pathInDir);
            $width = $size[0];
            $height = $size[1];

            return $width / $height;
        }

        function scaleImageByHeightAndRatio($image, $height){
            $width = $height * $this->ratio;
            return imagescale($image, $width, $height);
        }
    }
?>