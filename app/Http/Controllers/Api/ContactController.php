<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Http\Resources\ContactResource;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ContactResource::collection(Contact::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactFormRequest $request
     *
     * @return ContactResource
     */
    public function store(ContactFormRequest $request): ContactResource
    {
        $attributes            = $request->validated();
        $attributes['message'] = 'teasdaasdfgasdfg';

        $model = Contact::query()
            ->create($attributes);

        $contactEmail = setting('contact_email');

        $mailData = [
            'from'  => $attributes['email'],
            'title' => 'Mail from ItSolutionStuff.com',
            'body'  => 'This is for testing email using smtp.',
        ];

        Mail::to($contactEmail)->send(new ContactMail($mailData));

        return new ContactResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Contact $contact
     *
     * @return ContactResource
     */
    public function show(Contact $contact): ContactResource
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactFormRequest $request
     * @param Contact            $contact
     *
     * @return ContactResource
     */
    public function update(ContactFormRequest $request, Contact $contact): ContactResource
    {
        $contact->update($request->validated());

        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contact $contact
     *
     * @return Response
     */
    public function destroy(Contact $contact): Response
    {
        $contact->delete();

        return response()->noContent();
    }
}
