<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuoteFormRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return QuoteResource::collection(Quote::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuoteFormRequest $request
     *
     * @return QuoteResource
     */
    public function store(QuoteFormRequest $request): QuoteResource
    {
        $model = Quote::query()
            ->create($request->validated());

        return new QuoteResource($model);
    }

    /**
     * Display the specified resource.
     *
     * @param Quote $quote
     *
     * @return QuoteResource
     */
    public function show(Quote $quote): QuoteResource
    {
        return new QuoteResource($quote);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuoteFormRequest $request
     * @param Quote            $quote
     *
     * @return QuoteResource
     */
    public function update(QuoteFormRequest $request, Quote $quote): QuoteResource
    {
        $quote->update($request->validated());

        return new QuoteResource($quote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quote $quote
     * @return Response
     */
    public function destroy(Quote $quote): Response
    {
        $quote->delete();

        return response()->noContent();
    }
}
