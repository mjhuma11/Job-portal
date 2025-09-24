# User Credentials for Dashboard Access

## Default Role
All new users are assigned the **jobseeker** role by default, which grants access to the candidates dashboard.

## Admin User
- **Email**: admin@example.com
- **Password**: admin123
- **Role**: Admin (Full access to all dashboards)
- **User ID**: 5

## Employer User
- **Email**: employer@example.com
- **Password**: employer123
- **Role**: Employer (Access to employer dashboard)
- **User ID**: 6

## Job Seeker Users
All other users are assigned the jobseeker role by default, granting access to the candidates dashboard.

## Dashboard Access Summary
1. **Admin Dashboard**: Accessible only by users with the "admin" role
2. **Employer Dashboard**: Accessible by users with "employer" or "admin" roles
3. **Job Seeker Dashboard**: Accessible by users with "jobseeker" or "admin" roles

## Notes
- All passwords are hashed in the database
- The role assignment is handled automatically by the AssignRolesSeeder
- New users will automatically receive the "jobseeker" role unless they are associated with a company (which would assign them the "employer" role)