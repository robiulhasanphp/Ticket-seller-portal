# Ticket Seller Portal

A modern, production-ready Laravel application for managing ticket sales with broker-seller interactions, real-time messaging, and comprehensive order management.

## Features

- **Broker-Seller System**: Separate admin (broker) and seller user roles with role-based access control
- **Real-time Messaging**: Integrated conversation system between brokers and sellers
- **Ticket Management**: Create, manage, and track ticket listings
- **Order Management**: Track ticket sales with multiple status stages (reviewing, pending, sent, paid)
- **User Profiles**: Comprehensive seller profiles with address and bank information
- **Payout System**: Detailed payout tracking and management for sellers
- **Email Notifications**: Automated email alerts for new messages and important events
- **Responsive Design**: Modern, mobile-friendly interface built with Tailwind CSS

## Requirements

- **PHP 8.3+** (Uses modern PHP features: typed properties, match expressions, named arguments)
- **Laravel 10.x**
- **MySQL 8.0+** or **MariaDB 10.5+**
- **Composer 2.x**
- **Node.js 16+** (For frontend asset compilation)

### PHP Extensions Required

- `php-mysql` or `php-pdo` - Database connectivity
- `php-gd` - Image processing
- `php-xml` - XML processing
- `php-dom` - DOM manipulation
- `php-fileinfo` - File type detection
- `php-hash` - Hashing functions
- `php-json` - JSON support
- `php-mbstring` - Multi-byte string support
- `php-tokenizer` - Code tokenization
- `php-ctype` - Character type checking
- `php-filter` - Input filtering

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/ticket-seller-portal.git
cd ticket-seller-portal
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the `.env.example` file and configure your environment:

```bash
cp .env.example .env
```

Edit `.env` and update:

```env
APP_NAME="Ticket Seller Portal"
APP_ENV=production
APP_DEBUG=false
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticket_portal
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=your-mail-host.com
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS="noreply@ticketseller.com"
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database and Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional)

```bash
php artisan db:seed
```

### 8. Build Frontend Assets

```bash
npm run build
```

For development with hot-reload:

```bash
npm run dev
```

### 9. Create a Symlink for Storage (If Needed)

```bash
php artisan storage:link
```

### 10. Run the Application

For development:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Project Structure

```
ticket-seller-portal/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Request handlers
│   │   ├── Middleware/        # HTTP middleware
│   │   └── Livewire/          # Livewire components
│   ├── Models/                # Eloquent models
│   ├── View/
│   │   └── Components/        # Blade components
│   └── MyApp/                 # Custom application code
├── bootstrap/                 # Application bootstrap files
├── config/                    # Configuration files
├── database/
│   ├── factories/             # Model factories
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── public/
│   ├── index.php              # Application entry point
│   ├── images/                # Public images
│   └── uploads/               # Uploaded files (tickets, user files)
├── resources/
│   ├── css/                   # Stylesheets (Tailwind)
│   ├── js/                    # JavaScript files
│   └── views/                 # Blade templates
│       ├── auth/              # Authentication pages
│       ├── components/        # Reusable Blade components
│       ├── layouts/           # Layout templates
│       ├── livewire/          # Livewire component views
│       ├── email/             # Email templates
│       └── profile/           # User profile pages
├── routes/
│   ├── web.php                # Web routes
│   ├── api.php                # API routes
│   ├── auth.php               # Authentication routes
│   ├── channels.php           # Broadcasting channels
│   └── console.php            # Console routes
├── storage/                   # File storage (logs, cache, uploads)
├── tests/                     # Test files
├── vendor/                    # Composer dependencies
├── composer.json              # Composer configuration
├── package.json               # NPM configuration
├── vite.config.js             # Vite configuration
├── tailwind.config.js         # Tailwind CSS configuration
└── phpunit.xml                # PHPUnit configuration
```

## Usage

### User Roles

#### Broker (Admin)
- Manage all users and sellers
- View and respond to support messages
- Monitor all ticket and sales activities
- Approve seller requests
- View system statistics

#### Seller
- Create and manage ticket listings
- Track sales and orders
- Communicate with brokers
- Manage profile and account information
- View payout history

### Key Workflows

#### Creating a Ticket (Seller)
1. Navigate to "Tickets" → "Create New"
2. Fill in ticket details (event, date, quantity, price)
3. Submit for review
4. Broker reviews and approves

#### Sending a Ticket (Seller)
1. Navigate to "Sales" → "To Send"
2. Select ticket to ship
3. Update shipping information
4. Mark as sent

#### Messaging
1. Navigate to "Messages"
2. Select or create a conversation
3. Type and send message
4. Receive email notification

#### Managing Payouts
1. Navigate to "Payouts"
2. View payout schedule
3. View detailed payout history
4. Check bank account details

## Code Quality & Standards

### PSR Compliance
This project adheres to the following PHP Standards Recommendations (PSR):

- **PSR-1**: Basic Coding Standard
- **PSR-12**: Extended Coding Style Guide
- **PSR-4**: Autoloading Standard

### PHP 8.3 Features
The codebase leverages modern PHP 8.3 features:

- **Typed Properties**: All class properties use explicit type declarations
- **Named Arguments**: Consistent use of named function arguments
- **Match Expressions**: Used instead of switch statements where appropriate
- **Nullsafe Operator**: Safe property access using `?->`
- **Type Unions**: Flexible return types using union syntax

### Code Formatting
- All files use 4-space indentation
- Class names use `PascalCase`
- Method and variable names use `camelCase`
- Constants use `UPPERCASE_WITH_UNDERSCORES`
- Files end with a blank line

### Documentation
- Comprehensive PHPDoc comments on all classes and public methods
- Inline comments explain complex logic or business rules
- README files document key workflows and configurations

## Development

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/AuthenticationTest.php

# Run with coverage
php artisan test --coverage
```

### Code Quality

```bash
# Run PHP Lint (Laravel Pint)
./vendor/bin/pint

# Check code standards
php artisan tinker
```

### Database Migrations

```bash
# Create new migration
php artisan make:migration create_users_table

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh migration (be careful!)
php artisan migrate:fresh
```

### Clear Cache

```bash
# Clear all cached files
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Or use one command
php artisan optimize:clear
```

## Deployment

### Pre-Deployment Checklist

- [ ] Update `.env` for production
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Generate new `APP_KEY`
- [ ] Update database credentials
- [ ] Configure mail service
- [ ] Build frontend assets: `npm run build`
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Optimize composer: `composer install --optimize-autoloader --no-dev`

### Deployment Commands

```bash
# 1. Pull/clone latest code
git pull origin main

# 2. Install/update dependencies
composer install --optimize-autoloader --no-dev
npm ci --production

# 3. Build assets
npm run build

# 4. Run database migrations
php artisan migrate --force

# 5. Clear caches
php artisan optimize:clear
php artisan config:cache
php artisan route:cache

# 6. Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Required File Permissions

- `storage/` - 775
- `bootstrap/cache/` - 775
- `.env` - 644

## Security

### Security Best Practices Implemented

- **CSRF Protection**: All forms include CSRF tokens
- **Password Hashing**: Bcrypt with configurable rounds
- **SQL Injection Protection**: Parameterized queries via Eloquent ORM
- **XSS Protection**: Blade templating auto-escapes output
- **Input Validation**: Request validation on all inputs
- **Rate Limiting**: Throttle middleware on sensitive routes
- **Authentication**: Session-based with optional 2FA support

### Environment Variables

Never commit the `.env` file to version control. Always use environment variables for:

- Database credentials
- Mail service credentials
- API keys
- Encryption keys

## Troubleshooting

### Common Issues

#### "Class not found" Error
- Run `composer dump-autoload`
- Ensure class namespace matches file location

#### "Livewire component not found"
- Ensure component file is in `app/Http/Livewire/` directory
- Component class name matches filename
- Run `php artisan livewire:discover`

#### Database Connection Error
- Check `.env` database credentials
- Verify MySQL/MariaDB is running
- Confirm database exists: `mysql -u root -p ticket_portal`

#### Permission Denied on Storage
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

#### Vite Assets Not Loading
- Ensure `npm run dev` or `npm run build` was run
- Clear browser cache
- Check `public/hot` file exists (dev mode)

## Performance Optimization

### Caching

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache database queries
php artisan tinker
# Then in tinker: QueryBuilder::enabling();
```

### Database Optimization

- Add indexes to frequently queried columns
- Use eager loading with `->with()` to prevent N+1 queries
- Optimize database queries in Livewire components
- Use pagination for large datasets

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -am 'Add your feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Submit a Pull Request

## Support & Contact

For support, issues, or questions:

- **Email**: support@ticketseller.com
- **Issue Tracker**: [GitHub Issues](https://github.com/yourusername/ticket-seller-portal/issues)
- **Documentation**: See docs/ directory

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Changelog

### Version 1.0.0 (PHP 8.3 Release)
- **PHP 8.3 Compatibility**: Full support for PHP 8.3+
- **PSR Standards**: PSR-1 and PSR-12 compliance throughout
- **Code Quality**: Comprehensive type hints and modern PHP features
- **Documentation**: Professional README and code documentation
- **Template Updates**: Semantic HTML5 and accessibility improvements
- **Performance**: Optimized database queries and caching

---

**Last Updated**: April 2026
**Maintainer**: Development Team
**PHP Version**: 8.3+
**Laravel Version**: 10.x
