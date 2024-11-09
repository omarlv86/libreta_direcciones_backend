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
            $contacts = Contact::with(['address', 'mail', 'phone'])->get();
            return response()->json($contacts);
        } catch(Exception $e){
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Show contact by id
     *
     * @author ricardo omar lugo vargas <omarl.vargass@hotmail.com>
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        try {
            $contact = Contact::with(['address', 'mail', 'phone'])->where('id', $id)->get();
            return response()->json($contact);
        } catch (\Throwable $th) {
            return response()->json('Error al obtener el dato');
        }
    }

    /**
     * Edit contact 
     *
     * @author ricardo omar lugo vargas <omarl.vargass@hotmail.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        return response()->json($id);
    }

    /**
     * Detele contact
     *
     * @author ricardo omar lugo vargas <omarl.vargass@hotmail.com>
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        return response()->json($id);
    }
}
