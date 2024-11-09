<?php

namespace App\Http\Controllers\API;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    
    /**
     * Get all contacts
     *
     * @author ricardo omar lugo vargas <omarl.vargass@hotmail.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $contacts = Contact::all()->toArray();
            return response()->json($contacts);
        } catch(Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
