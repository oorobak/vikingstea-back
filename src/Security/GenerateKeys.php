<?php
//
//namespace App\Security;
//
//use App\Entity\AccessKeys;
//use App\Entity\User;
//use Doctrine\Common\Persistence\ObjectManager;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//
class GenerateKeys extends AbstractController
{
//    private $user;
//    private $em;
//
//    private $key = 'viking-76sdfg9';
//
//    public function __construct(ObjectManager $entityManager)
//    {
//        $this->em = $entityManager;
//    }
//
//    public function createNewLink(User $user, $target) {
//        if($user instanceof User) {
//            $this->user = $user;
//
//            try {
//                $rand = $this->rand(32);
//
//                $access_key = new AccessKeys();
//                $access_key->setType($target);
//                $access_key->setRand($rand);
//                $access_key->setApiKey($this->user->getApiKey());
//                $access_key->setDate(new \DateTime());
//                $this->em->persist($access_key);
//                $this->em->flush();
//
//                $key = $this->jwt($target, $rand);
//                $angular = $this->getParameter('angular_url') .
//                    $this->getParameter('angular_url_mail_prefix').
//                    $target.'/';
//
//                return $angular . $key;
//            } catch (\Exception $e) {
//                $data = array('error' => $e);
//                return $data;
//            }
//        } return false;
//    }
//
//    /**
//     * @param $target
//     * @param $rand
//     * @return \Exception|string
//     */
//    private function jwt($target,$rand) {
//        $jwt = new JWT();
//        try {
//            return $jwt->encode(
//                array(
//                    'target' => $target,
//                    'api' => $this->user->getApiKey(),
//                    'rand' => $rand
//                ),
//                $this->key);
//        } catch (\Exception $e) {
//            return $e;
//        }
//    }
//
//    private function rand($length = 10) {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < $length; $i++) {
//            $randomString .= $characters[rand(0, $charactersLength - 1)];
//        }
//        return $randomString;
//    }
}
