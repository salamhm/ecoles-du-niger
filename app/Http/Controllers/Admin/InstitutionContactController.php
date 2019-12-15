<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\InstitutionContract;
use App\Http\Controllers\BaseController;
use App\Models\InstitutionContact;
use Illuminate\Http\Request;

class InstitutionContactController extends BaseController
{
    protected $institutionRepository;

    public function __construct(InstitutionContract $institutionRepository)
    {
        $this->institutionRepository = $institutionRepository;
    }

    public function getContacts(Request $request)
    {
        $institution_id = $request->id;
        $institution = $this->institutionRepository->findInstitutionById($institution_id);
        $contacts = $institution->contacts;
        return ($contacts);

        return response()->json($contacts);
    }

    public function addContact(Request $request)
    {
        $this->validate($request, [
            'institution_id' => 'required',
            'number' => 'required',
        ]);

        $contact = InstitutionContact::create([
            'institution_id' => $request->institution_id,
            'number' => $request->number,
        ]);
        return response()->json($contact);

    }

    public function updateContact(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'institution_id' => 'required',
            'number' => 'required',
        ]);

        $contact = InstitutionContact::findOrFail($request->id);
        $contact->institution_id = $request->institution_id;
        $contact->number = $request->number;
        $contact->save();
        return response()->json($contact);
    }

    public function deleteContact(Request $request)
    {
        $contact = InstitutionContact::findOrFail($request->id);
        $contact->delete();
        
        return response()->json(['status' => 'success']);
    }
}