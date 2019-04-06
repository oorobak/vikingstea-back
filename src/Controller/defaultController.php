<?php
/**
 * Created by PhpStorm.
 * User: Kamil
 * Date: 18.03.2019
 * Time: 19:46
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class defaultController
{

    /**
     * @Route("/default")
     * @return Response
     * @throws \Exception
     */
    public function default()
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}