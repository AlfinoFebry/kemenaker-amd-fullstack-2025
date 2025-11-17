<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Models\Owner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('owner')->latest()->paginate(10);
        $owners = Owner::where('verified', true)->get();

        return view('pets.index', [
            'title'  => 'Daftar Hewan',
            'pets'   => $pets,
            'owners' => $owners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = Owner::where('verified', true)->get();
        return view('pets.create', compact('owners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_id'   => 'required|exists:owners,id',
            'pet_input'  => 'required|string',
        ]);

        [$name, $type, $age, $weight] = $this->parsePetInput($request->pet_input);

        if ($name === null || $type === null || $age === null || $weight === null) {
            return back()
                ->withInput()
                ->withErrors(['pet_input' => 'Format input hewan tidak valid.']);
        }

        $nameUpper = strtoupper($name);
        $typeUpper = strtoupper($type);

        $exists = Pet::where('owner_id', $request->owner_id)
            ->where('name', $nameUpper)
            ->where('type', $typeUpper)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['pet_input' => 'Pemilik ini sudah memiliki hewan dengan nama dan jenis yang sama.']);
        }

        $code = $this->generatePetCode($request->owner_id);

        $pet = Pet::create([
            'owner_id' => $request->owner_id,
            'code'     => $code,
            'name'     => $nameUpper,
            'type'     => $typeUpper,
            'age'      => $age,
            'weight'   => $weight,
        ]);

        return redirect()->route('pets.index')->with('success', 'Data hewan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Data hewan berhasil dihapus.');
    }

    private function parsePetInput(string $input): array
    {
        $normalized = preg_replace('/\s+/', ' ', trim($input));

        $parts = explode(' ', $normalized);

        if (count($parts) < 4) {
            return [null, null, null, null];
        }

        $name   = $parts[0];
        $type   = $parts[1];
        $rawAge = $parts[2];
        $rawWeight = $parts[3];

        $age    = $this->parseAge($rawAge);
        $weight = $this->parseWeight($rawWeight);

        if ($age === null || $weight === null) {
            return [null, null, null, null];
        }

        return [$name, $type, $age, $weight];
    }

    private function parseAge(string $raw): ?int
    {
        $raw = trim($raw);

        if (preg_match('/^(\d+)/', $raw, $matches)) {
            return (int) $matches[1];
        }

        return null;
    }

    private function parseWeight(string $raw): ?float
    {
        $raw = trim($raw);

        $raw = str_ireplace('kg', '', $raw);
        $raw = trim($raw);

        $raw = str_replace(',', '.', $raw);

        if (!is_numeric($raw)) {
            return null;
        }

        return (float) $raw;
    }

    private function generatePetCode(int $ownerId): string
    {
        $now = Carbon::now();
        $hhmm = $now->format('Hi');

        $ownerPart = str_pad($ownerId, 4, '0', STR_PAD_LEFT);

        $countPets = Pet::where('owner_id', $ownerId)->count();
        $sequence = $countPets + 1;
        $sequencePart = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return $hhmm . $ownerPart . $sequencePart;
    }
}
