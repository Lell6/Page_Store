<?php
    use Symfony\Component\Mailer\Mailer;
    use Symfony\Component\Mime\Email;
    use Symfony\Component\Mailer\Transport;    
    require_once '../vendor/autoload.php';

    Class Communication{
        public function printInfo($info){
            echo '<script>window.alert("'.$info.'");</script>';
        }

        public function sendEmail($email, $verificationKey){
            $transport = Transport::fromDsn('smtps://ola.kruzhylina@gmail.com:ioalkzvnwaysmrqt@smtp.gmail.com');
            $mailer = new Mailer($transport);
            $email = (new Email())
                ->from('ola.kruzhylina@gmail.com')
                ->to($email)
                ->subject('Login verification')
                ->text("Twój klucz weryfikacji: ".$verificationKey);
            $mailer->send($email);
        }
    }

    Class Navigation{
        public function redirectToPage($page){
            echo '<script>window.location = window.location.origin + "/store/'.$page.'";</script>';
        }
        public function redirectBack(){
            echo '<script>window.history.back();</script>';
        }
    }

    function printAndRedirect($info, $path){
        $serviceCommunication = new Communication();
        $serviceNavigator = new Navigation();
        
        $serviceCommunication->printInfo($info);
        $serviceNavigator->redirectToPage($path);
    }

    function checkPost($path){
        if(!$_SERVER['REQUEST_METHOD'] == "POST"){
            $serviceNavigator = new Navigation();
            $serviceNavigator->redirectToPage($path);
            exit();
        }
    }
?>