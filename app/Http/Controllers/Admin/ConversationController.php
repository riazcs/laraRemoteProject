<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Auth;

class ConversationController extends Controller
{
    public function chats()
    {
        $pageTitle = 'Support Chats';
        $emptyMessage = 'No Data found.';
        $items = Message::orderBy('id','desc')->paginate(getPaginate());
        return view('admin.message.chats', compact('items', 'pageTitle','emptyMessage'));
    }


}
