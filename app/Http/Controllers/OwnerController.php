<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::orderBy('created_at', 'desc')->paginate(10);

        return view('owners.index', [
            'title'  => 'Daftar Pemilik',
            'owners' => $owners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20|unique:owners,phone',
            'address' => 'nullable|string|max:255',
        ]);

        Owner::create([
            'name'           => $request->name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'verified' => false,
        ]);

        return redirect()->route('owners.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        if ($request->has('toggle_verify')) {
            $owner->verified = ! $owner->verified;
            $owner->save();

            return redirect()
                ->route('owners.index')
                ->with('success', 'Status verifikasi pemilik berhasil diperbarui.');
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20|unique:owners,phone,' . $owner->id,
            'address' => 'nullable|string|max:255',
        ]);

        $owner->update($request->only('name', 'phone', 'address'));

        return redirect()->route('owners.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()->route('owners.index')->with('success', 'Data pemilik berhasil dihapus.');
    }
}
