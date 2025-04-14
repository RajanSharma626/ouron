<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pin_code' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // If primary is selected, reset other addresses
        if ($request->has('primary')) {
            $user->addresses()->update(['default_address' => false]);
        }

        // Create new address
        $user->addresses()->create([
            'address' => $request->address,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
            'default_address' => $request->has('primary'),
        ]);


        return redirect()->route('profile')->with([
            'address-success' => 'Address added successfully.',
            'activeTab' => 'addressesTab',
        ]);
    }


    public function destroy($id)
    {
        $address = UserAddress::findOrFail($id);

        if ($address->user_id !== Auth::id()) {
            return redirect()->route('profile')->with(['error', 'Unauthorized action.', 'activeTab' => 'addressesTab']);
        }

        $address->delete();
        return redirect()->route('profile')->with(['address-success', 'Address deleted successfully.', 'activeTab' => 'addressesTab']);
    }

    public function setDefault($id)
    {
        $user = Auth::user();
        $address = UserAddress::findOrFail($id);

        if ($address->user_id !== $user->id) {
            return redirect()->route('profile')->with('error', 'Unauthorized action.');
        }

        // Remove default from all addresses
        $user->addresses()->update(['default_address' => false]);

        // Set the selected address as default
        $address->update(['default_address' => true]);

        return redirect()->route('profile')->with(['address-success', 'Default address updated successfully.', 'activeTab' => 'addressesTab']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pin_code' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $address = UserAddress::findOrFail($id);

        if ($address->user_id !== $user->id) {
            return redirect()->route('profile')->with('error', 'Unauthorized action.');
        }

        // Update the address details
        $address->update([
            'address' => $request->address,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
        ]);

        // If primary is selected, reset other addresses
        if ($request->has('primary')) {
            $user->addresses()->update(['default_address' => false]);
            $address->update(['default_address' => true]);
        }

        return redirect()->route('profile')->with([
            'address-success' => 'Address updated successfully.',
            'activeTab' => 'addressesTab',
        ]);
    }
}
