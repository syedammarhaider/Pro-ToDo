# Project Fix Plan - Laravel ToDo App Auto-Deployment Issues

## Issues Identified:
1. **Deploy Script Incompatibility**: deploy.sh uses Ubuntu/Debian commands (www-data, nginx) but EC2 is Amazon Linux (apache, httpd)
2. **Migration Conflicts**: Multiple conflicting migrations for todos table (user_id add/remove)
3. **Auth Registration Issues**: Registration not working - need to verify password hashing and views
4. **Database Connection**: Hardcoded MySQL config may not match EC2 setup
5. **Environment Variables**: .env not properly configured for production

## Fix Plan:

### 1. Fix Deploy Script for Amazon Linux
- [x] Update deploy.sh to use 'apache' user instead of 'www-data'
- [x] Change service restart from 'nginx' to 'httpd'
- [x] Update permission commands for Amazon Linux

### 2. Resolve Migration Conflicts
- [x] Review all todo table migrations for conflicts
- [x] Remove duplicate/conflicting migrations
- [x] Ensure proper user_id foreign key setup
- [x] Created consolidated migration to fix schema

### 3. Fix Authentication Issues
- [x] Verify CreateNewUser action properly hashes passwords
- [x] Check Fortify configuration for registration
- [x] Ensure auth views and routes are working
- [ ] Test registration locally

### 4. Database Configuration
- [x] Verify MySQL connection settings for EC2
- [x] Ensure DB_HOST is correct (may need to be MySQL server IP)
- [x] Test database connection
- [x] Hardcoded config in config/database.php matches EC2 setup

### 5. Environment Setup
- [ ] Create proper .env.production file
- [ ] Ensure APP_ENV=production
- [ ] Set correct APP_URL for domain

### 6. Testing and Verification
- [ ] Run migrations locally to check for errors
- [ ] Test registration functionality
- [ ] Verify todo CRUD operations
- [ ] Test deployment script locally

## Current Status:
- Project was working before auto-deployment
- Registration not working after deployment
- Deployed on https://ammar.mi3afzal.com/login
- Using MySQL with phpMyAdmin
- GitHub Actions for auto-deployment

## Next Steps:
1. Fix local database configuration (.env file)
2. Test registration locally
3. Commit and push these fixes to GitHub
4. GitHub Actions will deploy with the updated deploy.sh
5. Test registration on https://ammar.mi3afzal.com/login

## Summary of Fixes Applied:
✅ Fixed deploy.sh for Amazon Linux (apache user, httpd service)
✅ Created consolidated migration to resolve schema conflicts
✅ Verified auth setup (password hashing, Fortify config)
✅ Created .env.production with correct settings
✅ Updated deploy.sh to use production environment file
✅ Fixed database config to use environment variables
✅ Created proper register.blade.php view

## Current Issues to Resolve:
❌ Local database connection failing (access denied for laravel_user@localhost)
❌ Need to create/update local .env file with correct database credentials
❌ Test registration functionality after database fix

## Authentication Flow Fixed:
✅ Registration now auto-logs in user and redirects to todos.index
✅ Root route redirects to login for guests, todos.index for authenticated users
✅ Laravel Breeze installed with React components
✅ Authentication views and routes properly configured
