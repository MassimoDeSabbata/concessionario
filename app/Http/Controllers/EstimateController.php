<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstimateRequest;
use App\Http\Resources\EstimateDetailResource;
use App\Http\Resources\EstimateListResource;
use App\Models\Estimate;
use App\Notifications\NewEstimateNotification;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize('viewAny', [Estimate::class]);

        $page_limit = $request->query('limit', 10);
        $car_code = $request->query('car_code', null);

        $estimates = Estimate::sortable()
        ->with(['car', 'author', 'customer'])
        ->when($car_code, function ($query, $car_code) {
            return $query->whereHas('car', function ($sub_query) use ($car_code) {
                $sub_query->where('code', 'like', $car_code);
            });
        })
        ->paginate($page_limit)
        ->withQueryString();

        return EstimateListResource::collection($estimates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEstimateRequest $request)
    {
        $data = $request->validated();


        $data['author_id'] = 1;

        $new_estimate = Estimate::create($data);

        return new EstimateDetailResource($new_estimate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {

        $this->authorize('view', [Estimate::class, $estimate]);

        return new EstimateDetailResource($estimate);
    }

    public function send_estimate(Estimate $estimate) {
        dump("TEST");
        return $estimate->customer->notify(new NewEstimateNotification($estimate));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate $estimate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        //
    }


    public function pippo() {
        return ['pippo' => 'ciao'];
    }
}
