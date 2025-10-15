# Hotel Booking System

A web-based application for managing hotel bookings, built with the Laravel framework. This system provides an admin panel for managing rooms, bookings, and customers, as well as a user-facing frontend for browsing and booking rooms.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- A database (MySQL, PostgreSQL, or SQLite)

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/hotel-booking-system.git
   cd hotel-booking-system
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Set up the environment:**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Generate an application key:
     ```bash
     php artisan key:generate
     ```
   - Configure your database connection in the `.env` file.

4. **Run database migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

5. **Build frontend assets:**
   ```bash
   npm run dev
   ```

6. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

### Admin Panel

- Access the admin panel at `/admin`.
- Default login credentials (if seeded):
  - **Email:** `admin@example.com`
  - **Password:** `password`

From the admin panel, you can:
- Manage room listings, amenities, and policies.
- View and manage bookings.
- Manage customer accounts.

### Frontend

The frontend allows users to:
- Browse available rooms.
- Check room availability for specific dates.
- Make new bookings.
- View their own booking history (for logged-in users).

## Running the Tests

To run the automated tests for this system, use the following command:

```bash
./vendor/bin/phpunit
```

## Built With

- [Laravel](https://laravel.com/) - The web application framework used.
- [Tailwind CSS](https://tailwindcss.com/) - For styling the frontend.
- [Vite](https://vitejs.dev/) - For frontend build tooling.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
