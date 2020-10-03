<?php

namespace Turahe\Address\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Turahe\Address\Http\Requests\District\DistrictStoreRequest;
use Turahe\Address\Http\Requests\District\DistrictUpdateRequest;
use Turahe\Address\Models\District;

/**
 * Class DistrictController
 * @package Turahe\Address\Http\Controllers
 */
class DistrictController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $districts = District::with('cities')->autoSort()->autoFilter()->search(request('search'))->paginate();

        return  view('address::districts.index', compact('districts'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('address::districts.create');
    }

    /**
     * @param DistrictStoreRequest $request
     * @return RedirectResponse
     */
    public function store(DistrictStoreRequest $request): RedirectResponse
    {
        District::create($request->validated());

        return redirect()->route('address::districts.index')->with('success', 'District saved');
    }

    /**
     * @param District $district
     * @return View
     */
    public function edit(District $district): View
    {
        return view('address::districts.edit', compact('district'));
    }

    /**
     * @param DistrictUpdateRequest $request
     * @param District $district
     * @return RedirectResponse
     */
    public function update(DistrictUpdateRequest $request, District $district): RedirectResponse
    {
        $district->update($request->validated());

        return redirect()->route('address::districts.edit', $district)->with('success', 'District saved');
    }

    /**
     * @param District $district
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(District $district): RedirectResponse
    {
        try {
            $district->delete();

            return redirect()->route('address::districts.index')->with('success', 'District deleted');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}