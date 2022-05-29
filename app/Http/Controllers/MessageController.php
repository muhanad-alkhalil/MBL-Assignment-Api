<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /**
     * @OA\Get(
     *      path="/messages",
     *      operationId="getMessageList",
     *      tags={"Messages"},
     *      summary="Returns list of Messages",
     *      description="Get list of Messages For the Current User",
     *      security={ {"bearer": {} }},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                   property="data",
     *                   type="array",
     *                  @OA\Items(
     *                      ref="#/components/schemas/MessageResource",
     *                  )
     *              ),
     *          )
     *       ),
     *
     *      @OA\Response(
     *          response=401,
     *          description="Returns when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated.")
     *          )
     *      )
     * )
     */
    public function index()
    {
        $user = Auth::user();
        return MessageResource::collection($user->recivedMessages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/message/{id}",
     *      operationId="getMessageById",
     *      tags={"Messages"},
     *      summary="Returns a specific Message",
     *      description="Get specific Messages and Mark it as readed",
     *      security={ {"bearer": {} }},
     *
     *      @OA\Parameter(
     *      description="Message Id",
     *      in="path",
     *      name="id",
     *      required=true,
     *      example="1",
     *      @OA\Schema(
     *          type="integer",
     *          format="int64"
     *    )
     * ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                   property="data",
     *                   type="object",
     *                   ref="#/components/schemas/MessageResource",
     *              ),
     *          )
     *       ),
     *
     *      @OA\Response(
     *          response=403,
     *          description="Returns when user is not Authorized to see the message",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="unauthorized!")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Returns when user is not authenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated.")
     *          )
     *      ),
     *
     *
     *      @OA\Response(
     *          response=404,
     *          description="Returns when Message is not Found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The message not found!")
     *          )
     *      )
     *
     * )
     */

    public function show($id)
    {
        $message = Message::find($id);
        if (!$message) {
            return response(["message" => "The message not found!"], 404);
        }

        $user = Auth::user();
        if ($message->reciver->id != $user->id && $message->sender->id != $user->id) {
            return response(["message" => "unauthorized!"], 403);
        }

        if (!$message->isRead) {
            $message->isRead = 1;
            $message->save();
        }

        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // It should not be here i know, but i make it late 😅 Sorry 🙏

    public function user()
    {
        $user = Auth::user();
        $totalMessages = $user->recivedMessages->count();
        $unreadMessages = $user->recivedMessages->where('isRead', 0)->count();

        return [
            "data" => [
                "username" => $user->name,
                "totalMessages" => $totalMessages,
                "unreadMessages" => $unreadMessages,
            ]
        ];
    }
}
