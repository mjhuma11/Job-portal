# Role-Based Access Control Implementation

## Overview
This document describes the implementation of role-based access control (RBAC) for the Laravel job portal application. The system defines three roles: admin, employer, and jobseeker, with appropriate middleware to enforce access control.

## Roles Defined
1. **Admin** - Has full access to all system features
2. **Employer** - Can create/edit job posts, view applications
3. **Jobseeker** - Can apply for jobs, view jobs, manage profile

## Implementation Details

### 1. Database Structure
- Created `roles` table with columns: id, name, description, timestamps
- Added `role_id` foreign key to `users` table referencing `roles.id`

### 2. Models
- **Role Model**: Represents a user role with name and description
- **User Model**: Updated to include role relationship and helper methods:
  - `hasRole($roleName)` - Check if user has specific role
  - `isAdmin()` - Check if user is admin
  - `isEmployer()` - Check if user is employer
  - `isJobSeeker()` - Check if user is job seeker

### 3. Middleware
Created custom middleware for different access levels:

#### CheckRole
Generic middleware to check if user has any of the specified roles.
Usage: `middleware('role:admin,employer')`

#### AdminAccess
Ensures only admins can access the route.
Usage: `middleware('admin')`

#### EmployerAccess
Ensures only employers and admins can access the route.
Usage: `middleware('employer')`

#### JobSeekerAccess
Ensures only job seekers and admins can access the route.
Usage: `middleware('jobseeker')`

#### ApplyCheck
Ensures job seekers haven't already applied for a job before allowing a new application.
Usage: `middleware('apply.check')`

#### PostCheck
Ensures only employers and admins can post jobs, and employers can only edit their own job posts.
Usage: `middleware('post.check')`

### 4. Middleware Registration
Middleware aliases registered in `bootstrap/app.php`:
- `role` => CheckRole
- `admin` => AdminAccess
- `employer` => EmployerAccess
- `jobseeker` => JobSeekerAccess
- `apply.check` => ApplyCheck
- `post.check` => PostCheck

### 5. Route Protection
Routes have been updated to use appropriate middleware:

#### Admin Routes
- Protected with `admin` middleware

#### Job Seeker Routes
- Protected with `jobseeker` middleware
- Application submission protected with `apply.check` middleware

#### Employer Routes
- Protected with `employer` middleware
- Job creation, update, and deletion protected with `post.check` middleware

### 6. Seeders
- **RoleSeeder**: Populates the roles table with admin, employer, and jobseeker roles
- **AssignRolesSeeder**: Assigns appropriate roles to existing users based on their associations

## CSRF Protection
Laravel's built-in CSRF protection is used through the `VerifyCsrfToken` middleware, which is enabled by default in the web middleware group. No custom CSRF handling was implemented as the built-in protection is sufficient.

## Usage Examples

### In Controllers
```php
// Check if user has specific role
if ($user->hasRole('admin')) {
    // Admin-only code
}

// Use helper methods
if ($user->isAdmin()) {
    // Admin-only code
}
```

### In Routes
```php
// Protect route with specific role
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware('admin');

// Protect route with multiple roles
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('role:admin,employer');
```

### In Blade Templates
```blade
@can('admin')
    <!-- Admin-only content -->
@endcan

@if(auth()->user()->isAdmin())
    <!-- Admin-only content -->
@endif
```

## Future Enhancements
1. Implement role-based permissions system for more granular control
2. Add UI for administrators to manage user roles
3. Create role-specific dashboards with relevant information
4. Implement audit logging for role-based access