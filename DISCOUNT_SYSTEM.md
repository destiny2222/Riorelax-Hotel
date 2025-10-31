# Discount System Implementation

## Overview
Automatic 10% discount system for bookings with 5 or more room-days.

## Discount Rules
**10% discount applies when:**
- **Room-Days** = Rooms × Nights ≥ 5

### Examples:
- ✅ 1 room × 5 nights = 5 room-days → **10% discount**
- ✅ 5 rooms × 1 night = 5 room-days → **10% discount**
- ✅ 2 rooms × 3 nights = 6 room-days → **10% discount**
- ❌ 1 room × 4 nights = 4 room-days → **No discount**
- ❌ 2 rooms × 2 nights = 4 room-days → **No discount**

## Database Fields Added

### Bookings Table
- `subtotal` - Price before discount (price per night × nights × rooms)
- `discount_amount` - Discount amount in currency
- `discount_percentage` - Discount percentage (10.00)
- `total_amount` - Final amount after discount
- `room_days` - Calculated room-days (rooms × nights)

## Model Methods

### Booking Model (`app/Models/Booking.php`)

```php
// Calculate room-days
$booking->calculateRoomDays()

// Check if qualifies for discount
$booking->qualifiesForDiscount() // Returns true if room_days >= 5

// Calculate all booking totals with discount
$totals = $booking->calculateBookingTotals()
// Returns:
// [
//     'subtotal' => 5000.00,
//     'nights' => 5,
//     'room_days' => 5,
//     'discount_percentage' => 10,
//     'discount_amount' => 500.00,
//     'total_amount' => 4500.00
// ]
```

## How It Works

### 1. Booking Creation
When a booking is created, the system automatically:
1. Calculates subtotal based on room price, nights, and number of rooms
2. Calculates room-days (rooms × nights)
3. Applies 10% discount if room-days ≥ 5
4. Saves all discount data to database

### 2. Payment Processing
Payment amounts are calculated based on `total_amount` (already discounted):
- **Reservation (50%)**: `total_amount / 2`
- **Full Payment**: `total_amount`
- **Pay at Hotel**: No payment required

### 3. Admin Management
- Super Admin can edit `discount_amount` and `discount_percentage` directly
- Supervisor can edit discount fields directly
- Front Desk must request approval for discount changes

## Usage Examples

### Example 1: Single Room, 5 Nights
```
Room Price: ₦10,000/night
Rooms: 1
Nights: 5
Room-Days: 1 × 5 = 5

Subtotal: ₦10,000 × 5 × 1 = ₦50,000
Discount (10%): ₦5,000
Total: ₦45,000 ✅
```

### Example 2: 5 Rooms, 1 Night
```
Room Price: ₦10,000/night
Rooms: 5
Nights: 1
Room-Days: 5 × 1 = 5

Subtotal: ₦10,000 × 1 × 5 = ₦50,000
Discount (10%): ₦5,000
Total: ₦45,000 ✅
```

### Example 3: 2 Rooms, 3 Nights
```
Room Price: ₦10,000/night
Rooms: 2
Nights: 3
Room-Days: 2 × 3 = 6

Subtotal: ₦10,000 × 3 × 2 = ₦60,000
Discount (10%): ₦6,000
Total: ₦54,000 ✅
```

### Example 4: 1 Room, 3 Nights (No Discount)
```
Room Price: ₦10,000/night
Rooms: 1
Nights: 3
Room-Days: 1 × 3 = 3

Subtotal: ₦10,000 × 3 × 1 = ₦30,000
Discount: ₦0 (doesn't qualify)
Total: ₦30,000 ❌
```

## Display in Views

### Show Discount Information
```blade
@if($booking->qualifiesForDiscount())
    <div class="discount-badge">
        <i class="fas fa-tag"></i> 10% Discount Applied!
    </div>
@endif

<table>
    <tr>
        <td>Subtotal:</td>
        <td>₦{{ number_format($booking->subtotal, 2) }}</td>
    </tr>
    @if($booking->discount_amount > 0)
    <tr class="discount-row">
        <td>Discount ({{ $booking->discount_percentage }}%):</td>
        <td>-₦{{ number_format($booking->discount_amount, 2) }}</td>
    </tr>
    @endif
    <tr class="total-row">
        <td><strong>Total:</strong></td>
        <td><strong>₦{{ number_format($booking->total_amount, 2) }}</strong></td>
    </tr>
</table>

<p class="room-days-info">
    {{ $booking->rooms }} room(s) × {{ $booking->nights }} night(s) = 
    {{ $booking->room_days }} room-days
</p>
```

## Testing

### Test Scenarios
1. ✅ Book 1 room for 5 nights → Should show 10% discount
2. ✅ Book 5 rooms for 1 night → Should show 10% discount
3. ✅ Book 3 rooms for 2 nights (6 room-days) → Should show 10% discount
4. ❌ Book 1 room for 4 nights → Should NOT show discount
5. ❌ Book 2 rooms for 2 nights (4 room-days) → Should NOT show discount

## Files Modified

1. **Migration**: `database/migrations/2025_10_28_213209_add_discount_fields_to_bookings_table.php`
2. **Model**: `app/Models/Booking.php` - Added discount calculation methods
3. **Controller**: `app/Http/Controllers/Auth/BookingController.php` - Auto-calculate on booking creation
4. **Views**: Need to update payment form to show discount

## Future Enhancements

1. **Configurable Discount**:
   - Admin panel to set discount percentage
   - Different discount tiers (5%, 10%, 15%)
   - Seasonal discounts

2. **Multiple Discount Types**:
   - Early bird discount
   - Last-minute deals
   - Loyalty member discounts
   - Promo codes

3. **Discount Reports**:
   - Total discounts given
   - Revenue impact analysis
   - Most popular discount scenarios

## Notes

- Discount is calculated automatically on booking creation
- Payment amounts already include the discount
- Admin can manually adjust discount if needed
- All discount changes by Front Desk require approval
