<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="MBL Assigment",
 *      description="MBL Assigment By Muhanad Alkhalil",
 *      @OA\Contact(
 *          email="muhanad.alhalil@gmail.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )

 *
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints of for users Authentication"
 * )
 * @OA\Tag(
 *     name="Auth",
 *     description="API Endpoints of for users Authentication"
 * )
 * @OA\Tag(
 *     name="Messages",
 *     description="API Endpoints of for Messages"
 * )
 *
 * @OA\SecurityScheme(
 *    securityScheme="bearer",
 *    in="header",
 *    name="bearer",
 *    type="http",
 *    scheme="bearer",
 * ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
