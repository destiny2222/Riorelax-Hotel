# Roles and Permissions Management System

## Overview
This system implements a comprehensive role-based access control (RBAC) for the hotel management application with three distinct roles: **Super Admin**, **Supervisor**, and **Front Desk**.

---

## Roles and Their Permissions

### 1. Super Admin
**Full System Access** - Can perform all actions in the system

#### Permissions:
- ✅ **Bookings**: View, edit, delete, and create bookings with full control over amounts and discounts
- ✅ **Rooms**: View, create, edit, delete, and update room status
- ✅ **Customers**: View, edit, delete, and export customer list
- ✅ **Amenities**: Full CRUD operations
- ✅ **Approvals**: Approve or reject booking edit requests from Front Desk
- ✅ **QR Validation**: Validate bookings via QR code
- ✅ **Blade Editor**: Edit blade template files
- ✅ **Profile Management**: Edit own profile and change password

---

### 2. Supervisor
**Management and Approval Access**

#### Permissions:
- ✅ **Bookings**: View and edit bookings directly (including sensitive fields)
- ✅ **Rooms**: View rooms (read-only) and update room status
- ✅ **Customers**: View customer list (cannot export)
- ✅ **Approvals**: Approve or reject booking edit requests from Front Desk
- ✅ **QR Validation**: Validate bookings via QR code
- ✅ **Profile Management**: Edit own profile and change password

#### Restrictions:
- ❌ Cannot create, edit, or delete rooms
- ❌ Cannot export customer list
- ❌ Cannot delete bookings
- ❌ Cannot access amenities management
- ❌ Cannot access blade editor

---

### 3. Front Desk
**Operational Access with Approval Requirements**

#### Permissions:
- ✅ **Bookings**: View and edit bookings (non-sensitive fields immediately applied)
- ✅ **Customers**: View customer list
- ✅ **QR Validation**: Validate bookings via QR code
- ✅ **Profile Management**: Edit own profile and change password

#### Approval Required For:
- ⚠️ **Sensitive Fields**: Changes to `paid_amount`, `due_amount`, `check_in_date`, `check_out_date` require Supervisor/Super Admin approval

#### Restrictions:
- ❌ Cannot view or edit rooms
- ❌ Cannot delete bookings
- ❌ Cannot export customer list
- ❌ Cannot access amenities management
- ❌ Cannot access blade editor
- ❌ Cannot directly edit sensitive booking fields

---

## Booking Edit Approval Workflow

### How It Works

1. **Front Desk Initiates Edit**
   - Front Desk user edits a booking
   - Non-sensitive fields (adults, children, status, etc.) are updated immediately
   - Sensitive fields (amounts, dates) create an edit request in "pending" status

2. **Supervisor/Super Admin Reviews**
   - Can view all pending edit requests at `/admin/booking/pending-edits`
   - Can see original values vs. requested changes
   - Can approve or reject with reason

3. **Approval/Rejection**
   - **If Approved**: Changes are applied to the booking
   - **If Rejected**: Changes are discarded, and reason is recorded

### Sensitive Fields
Fields that require approval when edited by Front Desk:
- `paid_amount` - Amount paid by customer
- `due_amount` - Amount due from customer
- `check_in_date` - Check-in date
- `check_out_date` - Check-out date

---

## Database Structure

### 1. Admins Table
```sql
- id
- name
- email
- phone
- password
- role (enum: 'super-admin', 'supervisor', 'front-desk')
- image
- created_at
- updated_at
```

### 2. Booking Edit Requests Table
```sql
- id
- booking_id (foreign key to bookings)
- requested_by (foreign key to admins)
- approved_by (foreign key to admins, nullable)
- original_data (JSON - original booking values)
- requested_changes (JSON - requested new values)
- status (enum: 'pending', 'approved', 'rejected')
- rejection_reason (text, nullable)
- notes (text, nullable)
- approved_at (timestamp, nullable)
- created_at
- updated_at
```

---

## Admin Model Methods

### Role Checking Methods
```php
$admin->hasRole('super-admin')           // Check specific role
$admin->hasAnyRole(['supervisor', 'super-admin']) // Check multiple roles
$admin->isSuperAdmin()                   // Is Super Admin?
$admin->isSupervisor()                   // Is Supervisor?
$admin->isFrontDesk()                    // Is Front Desk?
```

### Permission Methods
```php
$admin->canApproveBookingEdits()         // Can approve edit requests?
$admin->canEditRooms()                   // Can edit rooms?
$admin->canDeleteBookings()              // Can delete bookings?
$admin->canExportCustomers()             // Can export customer list?
$admin->canDirectlyEditSensitiveFields() // Can edit sensitive fields without approval?
$admin->canUpdateRoomStatus()            // Can update room status?
```

---

## Routes Overview

### Protected by Role Middleware
All admin routes use the `role` middleware to enforce permissions:

```php
// Super Admin only
Route::middleware(['role:super-admin'])->group(function () {
    // Room management, amenities, blade editor, etc.
});

// Supervisor and Super Admin
Route::middleware(['role:super-admin,supervisor'])->group(function () {
    // Approval routes
});

// All roles
Route::middleware(['role:super-admin,supervisor,front-desk'])->group(function () {
    // Booking views, customer list, QR validation
});
```

---

## Setting Up Admin Users

### Creating Admin Users

1. **Via Database Seeder**:
```php
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

Admin::create([
    'name' => 'John Doe',
    'email' => 'john@hotel.com',
    'phone' => '1234567890',
    'password' => Hash::make('password'),
    'role' => 'super-admin', // or 'supervisor' or 'front-desk'
]);
```

2. **Via Tinker**:
```bash
php artisan tinker
```
```php
$admin = new App\Models\Admin();
$admin->name = 'Jane Smith';
$admin->email = 'jane@hotel.com';
$admin->phone = '0987654321';
$admin->password = bcrypt('password');
$admin->role = 'supervisor';
$admin->save();
```

3. **Update Existing Admin Role**:
```bash
php artisan tinker
```
```php
$admin = App\Models\Admin::where('email', 'admin@hotel.com')->first();
$admin->role = 'super-admin';
$admin->save();
```

---

## Usage Examples

### Example 1: Front Desk Editing Booking

```php
// Front Desk user edits a booking
// Non-sensitive fields update immediately
// Sensitive fields create approval request

// In BookingController@update
$booking->update([
    'adults' => 2,          // ✅ Updated immediately
    'children' => 1,        // ✅ Updated immediately
    'paid_amount' => 500,   // ⚠️ Creates approval request
]);
```

### Example 2: Supervisor Approving Edit

```php
// Supervisor views pending requests
GET /admin/booking/pending-edits

// Supervisor approves request
PUT /admin/booking/edit-request/{id}/approve

// Changes are applied to booking
```

### Example 3: Checking Permissions in Blade

```blade
@if(auth('admin')->user()->canApproveBookingEdits())
    <a href="{{ route('admin.booking.pending-edits') }}">
        Pending Approvals ({{ $pendingEditRequestsCount }})
    </a>
@endif

@if(auth('admin')->user()->canDeleteBookings())
    <button class="btn-delete">Delete Booking</button>
@endif
```

---

## Middleware Logic

The `RoleMiddleware` enforces access control:

1. Checks if user is authenticated
2. Parses comma-separated roles from route definition
3. Super Admin gets automatic access to everything
4. Checks if user has any of the required roles
5. Denies access if no role matches

---

## Security Considerations

1. **Role Column**: Primary method for role checking (fast and simple)
2. **Fallback to Relationships**: If role column is empty, checks role relationships
3. **Audit Trail**: All edit requests track who requested and who approved
4. **Immutable Sensitive Fields**: Front Desk cannot directly modify sensitive fields
5. **Rejection Reasons**: Required when rejecting edit requests for accountability

---

## Testing Roles

### Test Super Admin Access
1. Login as super-admin
2. Should see all menu items
3. Can access all pages without restrictions

### Test Supervisor Access
1. Login as supervisor
2. Should see pending edit requests
3. Can approve/reject requests
4. Cannot edit rooms or access blade editor

### Test Front Desk Access
1. Login as front-desk
2. Can edit bookings
3. Sensitive field changes create approval requests
4. Cannot delete bookings or edit rooms

---

## Troubleshooting

### "You do not have permission to access this page"

**Possible Causes**:
1. Admin role is not set correctly
2. Role middleware is not registered
3. Route is protected but user doesn't have required role

**Solution**:
```bash
# Check admin role
php artisan tinker
App\Models\Admin::find(1)->role;

# Update if needed
$admin = App\Models\Admin::find(1);
$admin->role = 'super-admin';
$admin->save();
```

### Pending Edit Requests Not Showing

**Possible Causes**:
1. BookingEditRequest relationship not set
2. Status filter issue

**Solution**:
```php
// Check pending requests
BookingEditRequest::where('status', 'pending')->get();
```

---

## Future Enhancements

1. **Email Notifications**: Notify supervisors when edit requests are created
2. **Edit History**: Track all booking changes with timestamps
3. **Bulk Approvals**: Approve multiple requests at once
4. **Role Permissions UI**: Admin panel to manage roles and permissions
5. **Custom Permissions**: Fine-grained permissions beyond roles

---

## Summary

This roles and permissions system provides:
- ✅ **Clear role separation** with three distinct levels
- ✅ **Approval workflow** for sensitive changes
- ✅ **Audit trail** for all edit requests
- ✅ **Flexible middleware** for route protection
- ✅ **Helper methods** for easy permission checking

All changes are tracked, sensitive fields require approval, and the system maintains a clear hierarchy of access control.
