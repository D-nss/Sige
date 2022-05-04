<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function getItemById(Request $request)
    {
        $itens = Item::where('tipo_item_id', $request->tipo_item)->get()->toArray();

        echo json_encode($itens);
    }
}
