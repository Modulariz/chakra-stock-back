<?php

namespace App\Http\Controllers;

use App\Interfaces\Services\ContactsServiceInterface;
use Illuminate\Http\Request;

/**
 * Representación del recurso de contactos.
 *
 * @Resource("Contactos", uri="/contacts")
 */
class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(ContactsServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Mostrar los contactos filtrados por nombre, rol y offset. Ordenados por nombre, rol, fecha de creación, fecha de actualización o deuda.
     * El límite está programado a 10.
     * Los roles son "c" para los clientes y "p" para los proveedores
     * 
     * @Get("/")
     * 
     * @Request("search=string&role=c|p&order=name|created_at|updated_at|money&offset=integer", contentType="application/x-www-form-urlencoded", headers={"Authorization": "Bearer {token}"})
     * @Request({"search": "string", "role": "c|p", "order": "name|created_at|updated_at|money", "offset": "integer"}, headers={"Authorization": "Bearer {token}"})
     * @Response(200, body={"response":{{"contact_id": "integer", "address": "string", "name": "string", "phone": "string", "money": "integer", "created_at": "timestamp", "updated_at": "timestamp", "deleted_at": "null"}}, "count":"integer"})
     */
    public function getContacts(Request $request)
    {
        //saca los 4 parametros de la url
        $offset = $request->get('offset') ? $request->get('offset') : 0;
        $search = $request->get('search') ? $request->get('search') : '';
        //role es 'c' o 'p', clientes o proveedores respectivamente
        //por default quiero que devuelva clientes
        //deberia buscar una forma de validar 'role' para que solamente pueda ser 'c' o 'p'
        $role = $request->get('role') ? $request->get('role') : 'c';
        $order = $request->get('order') ? $request->get('order') : 'name';
        //deberia preguntarle a alguien si esto se puede refactorizar, son demasiados parametros para una sola funcion
        return $this->service->getContacts($offset, $search, $role, $order);
    }

    public function getContactsMinified()
    {
        return $this->service->getContactsMinified();
    }

    public function getContactById(int $id)
    {
        return $this->service->getContactById($id);
    }

    public function deleteContactById(Request $request)
    {
        $this->validate($request, [
            'contact_id' => 'required|exists:contacts,contact_id'
        ]);
        $id = $request->get('contact_id');
        return $this->service->deleteContactById($id);
    }

    public function postContact(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|between:4,30',
                'phone' => 'required|digits_between:4,30|numeric|unique:contacts,phone',
                'address' => 'required|string|between:4,30',
                'role' => 'required|string|size:1',
                'money' => 'required|numeric'
            ]
        );
        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $role = $request->get('role');
        $money = $request->get('money');
        return $this->service->postContact($name, $phone, $role, $money, $address);
    }

    public function updateContact(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|between:4,30',
                'address' => 'required|string|between:4,30',
                'contact_id' => 'required|integer|exists:contacts,contact_id',
                'money' => 'required|numeric',
                'phone' => 'required|numeric|unique:contacts,phone,'
                    . $request->get('contact_id') .
                    ',contact_id'
            ]
        );
        $name = $request->get('name');
        $phone = $request->get('phone');
        $address = $request->get('address');
        $money = $request->get('money');
        $id = $request->get('contact_id');
        return $this->service->updateContact($name, $phone, $address, $money, $id);
    }
}
