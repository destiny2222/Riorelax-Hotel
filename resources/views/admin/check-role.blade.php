<!DOCTYPE html>
<html>
<head>
    <title>Check Current Admin Role</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .info { background: #e3f2fd; padding: 15px; border-radius: 4px; margin: 10px 0; }
        .role { font-size: 24px; font-weight: bold; color: #1976d2; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #1976d2; color: white; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .super-admin { background: #4caf50; color: white; }
        .supervisor { background: #ff9800; color: white; }
        .front-desk { background: #2196f3; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Current Admin User Information</h1>
        
        @auth('admin')
            <div class="info">
                <p><strong>Name:</strong> {{ auth('admin')->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth('admin')->user()->email }}</p>
                <p><strong>Role:</strong> <span class="role">{{ auth('admin')->user()->role ?? 'NOT SET' }}</span></p>
            </div>

            <h2>Role Checks</h2>
            <table>
                <tr>
                    <th>Check</th>
                    <th>Result</th>
                </tr>
                <tr>
                    <td>Is Super Admin?</td>
                    <td>{{ auth('admin')->user()->isSuperAdmin() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
                <tr>
                    <td>Is Supervisor?</td>
                    <td>{{ auth('admin')->user()->isSupervisor() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
                <tr>
                    <td>Is Front Desk?</td>
                    <td>{{ auth('admin')->user()->isFrontDesk() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
                <tr>
                    <td>Can Edit Rooms?</td>
                    <td>{{ auth('admin')->user()->canEditRooms() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
                <tr>
                    <td>Can Delete Bookings?</td>
                    <td>{{ auth('admin')->user()->canDeleteBookings() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
                <tr>
                    <td>Can Approve Edits?</td>
                    <td>{{ auth('admin')->user()->canApproveBookingEdits() ? '✅ YES' : '❌ NO' }}</td>
                </tr>
            </table>

            <h2>All Admins in System</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                @foreach(App\Models\Admin::all() as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if($admin->role == 'super-admin')
                            <span class="badge super-admin">SUPER ADMIN</span>
                        @elseif($admin->role == 'supervisor')
                            <span class="badge supervisor">SUPERVISOR</span>
                        @elseif($admin->role == 'front-desk')
                            <span class="badge front-desk">FRONT DESK</span>
                        @else
                            <span class="badge">{{ $admin->role ?? 'NOT SET' }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <div class="info">
                <p>You are not logged in as an admin.</p>
            </div>
        @endauth

        <div style="margin-top: 30px;">
            <a href="{{ route('admin.home') }}" style="color: #1976d2;">← Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
