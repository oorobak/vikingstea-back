<?php


namespace App\Security;

use App\Entity\UsUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class SecurityController extends AbstractController
{
    private const header = array(
        'Access-Control-Allow-Origin' => '*',
        'Content-type' => 'application/json'
    );
    private $key = 'viking-76sdfg9';

    /**
     * @param Request $request
     * @Route("/login", name="login")
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // $data['auth']['login']
        // todo: obsługa dla : $data['auth']['email']
        // $data['auth']['pass']

        if (isset($data['auth']) && (isset($data['auth']['login']) || isset($data['auth']['email'])) && $data['auth']['pass']) {
            if ($data['auth']['pass'] != '') {

                ($data['auth']['login'] != '') ? $login = $data['auth']['login'] : $login = false;
                ($data['auth']['email'] != '') ? $email = $data['auth']['email'] : $email = false;

                ($login) ? $field = 'login' : ($email) ? $field = 'email' : $field = false;
                ($field == 'login') ? $findByData = $login : ($field == 'email') ? $findByData = $email : $findByData = false;

                if ($field && $findByData) {
                    $encoder = new BCryptPasswordEncoder(12);
                    $factory = new EncoderFactory(array(UsUser::class => $encoder));
                    $user = $this->getDoctrine()->getManager()->getRepository(UsUser::class)
                        ->findBy(array($field => $findByData));

                    if ($user instanceof UsUser) {
                        $check = $factory->getEncoder($user);
                        if($check->isPasswordValid($user->getPassword(),$data['auth']['pass'],12)) {
                            $token = $this->generate_token($user);
                            return new JsonResponse(
                                array(
                                    'message' => 'You are validate',
                                    'status' => 'success',
                                    'token' => $token,
                                    // add your extra data here
                                ),
                                Response::HTTP_OK,
                                self::header
                            );
                        } else {
                            return new JsonResponse(
                                'Username or password not valid',
                                Response::HTTP_UNAUTHORIZED,
                                self::header
                            );
                        }
                    } else {
                        return new JsonResponse(
                            'User doesnt exist',
                            Response::HTTP_UNAUTHORIZED,
                            self::header
                        );
                    }
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        if($error) {
            return new JsonResponse(
                array(
                    'message' => 'Login or password not send',
                    'status' => 'error'
                ),
                Response::HTTP_OK,
                self::header
            );
        } else {
            return new JsonResponse(
                array(
                    'message' => 'Something wrong happened here',
                    'status' => 'error'
                ),
                Response::HTTP_OK,
                self::header
            );
        }
    }

    private function generate_token(UsUser $user) {
        try {
            return JWT::encode(
                array(
                    'id' => $user->getId(),
                    'login' => $user->getLogin(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRoles()[0]
                ),
                $this->key);
        } catch (Exception $e) {
            return $e;
        }
    }

}