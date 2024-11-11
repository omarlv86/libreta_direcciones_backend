<?php

namespace App\Http\Controllers\API;

use App\Models\Mail;
use App\Models\Phone;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            $contacts = Contact::where('status', 1)->paginate(50);
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
            $contact = Contact::with(['addresses', 'mails', 'phones'])->where('id', $id)->first();
            return response()->json($contact);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json('Error al obtener el dato');
        }
    }

    /**
     * Create contact
     *
     * @author ricardo omar lugo vargas <omarl.vargass@hotmail.com>
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        //DB::beginTransaction();
        try {
            if($request->id == ""){
                $contact = Contact::create([
                    'name' => $request->name,
                    'note' => $request->note,
                    'birthday' => $request->birthday,
                    'work' => $request->work,
                    'web' => $request->web,
                    'status' => 1
                ]);

                foreach ($request->cellphones as $phone) {
                    if (!empty($phone['phone'])) {
                        $contact->phones()->create([
                            'phone' => $phone['phone']
                        ]);
                    }
                    
                }
    
                foreach ($request->mails as $mail) {
                    if (!empty($mail['email'])) {                    
                        $contact->mails()->create([
                            'email' => $mail['email']
                        ]);
                    }
                }

                foreach ($request->addresses as $address) {
                    if(!empty($address['street']) || !empty($address['city']) || !empty($address['state']) || !empty($address['country'])){
                        $contact->addresses()->create([
                            'street' => $address['street'],
                            'city' => $address['city'],
                            'state' => $address['state'],
                            'country' => $address['country'],
                            'postal_code' => $address['postal_code'],
                        ]);
                    }
                }

                return response()->json(['message' => 'Contacto creado correctamente!'], 200);

            }else{
                
                Log::info('Actualizar contacto');
                $contact = Contact::find($request->id);
                $contact->update([
                    'name' => $request->name,
                    'note' => $request->note,
                    'birthday' => $request->birthday,
                    'work' => $request->work,
                    'web' => $request->web,
                ]);

                if (isset($request->cellphones)) {
                    foreach ($request->cellphones as $phoneData) {
                        $contact->phones()->updateOrCreate(
                            ['id' => $phoneData['id'] ?? null],
                            ['phone' => $phoneData['phone']]
                        );
                    }
                }

                if (isset($request->mails)) {
                    foreach ($request->mails as $mailData) {
                        $contact->mails()->updateOrCreate(
                            ['id' => $mailData['id'] ?? null],
                            ['email' => $mailData['email']]
                        );
                    }
                } 

                if (isset($request->addresses)) {
                    foreach ($request->addresses as $addressData) {
                        $contact->mails()->updateOrCreate(
                            ['id' => $addressData['id'] ?? null],
                            ['street' => $addressData['street']],
                            ['city' => $addressData['city']],
                            ['state' => $addressData['state']],
                            ['country' => $addressData['country']],
                            ['postal_code' => $addressData['postal_code']]
                        );
                    }
                } 
                
                return response()->json(['message' => 'Contacto actualizado correctamente!', 'data' => $contact->load('addresses', 'mails', 'phones')], 200, );
            }
            
            //DB::commit();

            
        } catch (\Throwable $th) {
            
            Log::error($th);
            //DB::rollback();
            return response()->json(['error' => 'Ocurrió un error al registrar el contacto'], 500);
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
    public function delete(Contact $contact){
        
        $contact->update([ 'status' => 0 ]);
        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }

    public function validateModel($data, $model){
        $columnas = $model->getFillable();
        if (count(array_filter($propiedades)) > 0) {
        Log::info($columnas);
        }

        /* foreach ($columnas as $columna) {
            
            Log::info($columna);
            
            echo $columna . '<br>';
        } */
    }

}
