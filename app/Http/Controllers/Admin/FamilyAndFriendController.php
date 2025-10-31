<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FamilyAndFriend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class FamilyAndFriendController extends Controller
{
    public function index()
    {
        $familyAndFriends = FamilyAndFriend::with('addedBy')->latest()->paginate(15);
        return view('admin.family-friends.index', compact('familyAndFriends'));
    }

    public function create()
    {
        return view('admin.family-friends.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        // Check if user has permission
        if (!$admin->hasAnyRole(['super-admin', 'supervisor'])) {
            Alert::error('Access Denied', 'You do not have permission to add family and friends.');
            return redirect()->route('admin.home');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:family_and_friends,email',
            'phone' => 'nullable|string|unique:family_and_friends,phone',
        ]);

        // At least one of email or phone must be provided
        if (!$request->email && !$request->phone) {
            Alert::error('Validation Error', 'Please provide at least email or phone number.');
            return back()->withInput();
        }

        try {
            $familyFriend = FamilyAndFriend::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'added_by' => $admin->id,
                'is_active' => true,
            ]);

            // Check if there's an existing user with this email or phone and generate discount code
            $this->generateDiscountCodeForExistingUser($request->email, $request->phone);

            Alert::success('Success', 'Family & Friend added successfully. Discount codes generated for existing users.');
            return redirect()->route('admin.family-friends.index');
        } catch (\Exception $e) {
            Log::error('Failed to add family and friend: ' . $e->getMessage());
            Alert::error('Error', 'Failed to add family and friend.');
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $familyFriend = FamilyAndFriend::findOrFail($id);
        return view('admin.family-friends.edit', compact('familyFriend'));
    }

    public function update(Request $request, $id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasAnyRole(['super-admin', 'supervisor'])) {
            Alert::error('Access Denied', 'You do not have permission to update family and friends.');
            return redirect()->route('admin.home');
        }

        $familyFriend = FamilyAndFriend::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:family_and_friends,email,' . $id,
            'phone' => 'nullable|string|unique:family_and_friends,phone,' . $id,
            'is_active' => 'nullable|boolean',
        ]);

        if (!$request->email && !$request->phone) {
            Alert::error('Validation Error', 'Please provide at least email or phone number.');
            return back()->withInput();
        }

        try {
            $familyFriend->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => $request->has('is_active'),
            ]);

            // If being reactivated, check for existing users and generate discount codes
            if ($request->has('is_active') && !$familyFriend->wasChanged('is_active') === false) {
                $this->generateDiscountCodeForExistingUser($request->email, $request->phone);
            }

            Alert::success('Success', 'Family & Friend updated successfully.');
            return redirect()->route('admin.family-friends.index');
        } catch (\Exception $e) {
            Log::error('Failed to update family and friend: ' . $e->getMessage());
            Alert::error('Error', 'Failed to update family and friend.');
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasAnyRole(['super-admin', 'supervisor'])) {
            Alert::error('Access Denied', 'You do not have permission to delete family and friends.');
            return redirect()->route('admin.home');
        }

        try {
            $familyFriend = FamilyAndFriend::findOrFail($id);
            $familyFriend->delete();

            Alert::success('Success', 'Family & Friend deleted successfully.');
            return redirect()->route('admin.family-friends.index');
        } catch (\Exception $e) {
            Log::error('Failed to delete family and friend: ' . $e->getMessage());
            Alert::error('Error', 'Failed to delete family and friend.');
            return back();
        }
    }

    /**
     * Generate discount code for existing users when added to family and friends
     */
    private function generateDiscountCodeForExistingUser($email, $phone)
    {
        // Find users by email or phone
        $users = User::where(function($query) use ($email, $phone) {
            if ($email) {
                $query->where('email', $email);
            }
            if ($phone) {
                $query->orWhere('phone', $phone);
            }
        })->get();

        $generatedCount = 0;
        foreach ($users as $user) {
            // Check if user doesn't already have a discount code
            if (!$user->discountCode()->exists()) {
                // Generate discount code for this user
                $discountCode = $user->generateDiscountCodeIfEligible();
                if ($discountCode) {
                    $generatedCount++;
                    Log::info("Generated discount code {$discountCode->code} for existing user {$user->email}");
                }
            }
        }

        if ($generatedCount > 0) {
            Log::info("Generated {$generatedCount} discount codes for existing users");
        }
    }

    /**
     * Retroactively generate discount codes for all existing users in family and friends
     */
    public function generateCodesForExistingUsers()
    {
        /** @var \App\Models\Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!$admin->hasAnyRole(['super-admin'])) {
            Alert::error('Access Denied', 'Only super admin can perform this action.');
            return redirect()->route('admin.home');
        }

        try {
            $familyAndFriends = FamilyAndFriend::where('is_active', true)->get();
            $totalGenerated = 0;

            foreach ($familyAndFriends as $familyFriend) {
                // Find users by email or phone
                $users = User::where(function($query) use ($familyFriend) {
                    if ($familyFriend->email) {
                        $query->where('email', $familyFriend->email);
                    }
                    if ($familyFriend->phone) {
                        $query->orWhere('phone', $familyFriend->phone);
                    }
                })->get();

                foreach ($users as $user) {
                    // Check if user doesn't already have a discount code
                    if (!$user->discountCode()->exists()) {
                        // Generate discount code for this user
                        $discountCode = $user->generateDiscountCodeIfEligible();
                        if ($discountCode) {
                            $totalGenerated++;
                        }
                    }
                }
            }

            Alert::success('Success', "Generated {$totalGenerated} discount codes for existing users.");
            return redirect()->route('admin.family-friends.index');

        } catch (\Exception $e) {
            Log::error('Failed to generate codes for existing users: ' . $e->getMessage());
            Alert::error('Error', 'Failed to generate discount codes.');
            return back();
        }
    }
}
