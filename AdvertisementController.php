<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
       return view('admin-advertise.index');
    }

    // Show the form for creating a new advertisement
    public function create()
    {
        return view('admin.advertise');
    }

    // Store a new advertisement in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mem_email' => 'required|email|unique:advertisements,mem_email',
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required',
            'size' => 'required|numeric',
            'cost' => 'required|numeric|min:0|max:999999.99',
        ]);
    
        // If an image is uploaded, handle it
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('advertisements', 'public');
        }
    
        // Save the data to the database
        Advertisement::create($validated);
    
        // Redirect with success message
        return redirect()->route('admin-advertise.index')->with('success', 'Advertisement created successfully!');

        $advertisements = new Advertisement();
        $newadvertisement->mem_email = $request->mem_email;
        $advertisements->title = $request->input('title');
        $advertisements->description = $request->input('description');
        $advertisements->image = $request->input('image');
        $advertisements->start_date = $request->input('start_date');
        $advertisements->end_date = $request->input('end_date');
        $advertisements->location = $request->input('location');
        $advertisements->size = $request->input('size');
        $advertisements->cost = $request->input('cost');

        $advertisements->save();
        return redirect()->route('admin-advertise.index')->with('success', 'Advertisement created successfully!');
    }

    // Display a specific advertisement
    public function show(Advertisement $advertisement)
    {
       //
    }

    // Show the form for editing a specific advertisement
    public function edit(Advertisement $advertisement)
    {
        //
    }

    // Update a specific advertisement
    public function update(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'mem_email' => 'required|email',
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required',
            'size' => 'required|numeric',
            'cost' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
            $data['image'] = $request->file('image')->store('advertisements', 'public');
        }

        $advertisement->update($data);

        return redirect()->route('advertisements.index')->with('success', 'Advertisement updated successfully!');
    }

    // Delete a specific advertisement
    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->image) {
            Storage::disk('public')->delete($advertisement->image);
        }
        $advertisement->delete();

        return redirect()->route('admin-advertise.index')->with('success', 'Advertisement deleted successfully!');
    }

}
