# Auto-Deployment Setup Guide

## 🚀 Complete CI/CD Pipeline Setup

### Step 1: Initialize Git Repository
```bash
git init
git add .
git commit -m "Initial commit with auto-deployment setup"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git push -u origin main
```

### Step 2: Setup GitHub Secrets
Go to your GitHub repository → Settings → Secrets and variables → Actions → New repository secret

Add these secrets:

1. **EC2_HOST**: `100.53.28.191` (your EC2 public IP)
2. **EC2_USERNAME**: `ec2-user` 
3. **EC2_SSH_KEY**: Your private key content (copy entire `test key.pem` file)

### Step 3: Setup EC2 for Auto-Deployment
```bash
# SSH into your EC2 instance
ssh -i "test key.pem" ec2-user@100.53.28.191

# Install Git if not installed
sudo yum install git -y

# Navigate to project directory
cd /var/www/laravel

# Initialize Git and connect to GitHub
git init
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git pull origin main

# Create deploy script
nano deploy.sh
# (copy deploy.sh content here)

# Make deploy script executable
chmod +x deploy.sh

# Setup GitHub webhook (optional but recommended)
# Install webhook handler
sudo yum install nodejs npm -y
npm install -g github-webhook-handler
```

### Step 4: Test Auto-Deployment

#### Method 1: GitHub Actions (Recommended)
1. Push any change to your GitHub repository
2. Go to Actions tab in GitHub
3. Watch the deployment process
4. Check your EC2 instance after deployment

#### Method 2: Manual Deployment
```bash
# SSH into EC2 and run
cd /var/www/laravel
./deploy.sh
```

### Step 5: Setup Webhook (Optional)
Create a webhook file on EC2:
```bash
# Create webhook server
nano webhook-server.js
```

```javascript
const http = require('http');
const { exec } = require('child_process');

const server = http.createServer((req, res) => {
    if (req.method === 'POST' && req.url === '/webhook') {
        let body = '';
        req.on('data', chunk => {
            body += chunk.toString();
        });
        req.on('end', () => {
            console.log('Webhook received, deploying...');
            exec('./deploy.sh', (error, stdout, stderr) => {
                if (error) {
                    console.error(`Error: ${error}`);
                    return;
                }
                console.log(`Deployment output: ${stdout}`);
            });
            res.writeHead(200, { 'Content-Type': 'text/plain' });
            res.end('Deployment started!');
        });
    } else {
        res.writeHead(404);
        res.end();
    }
});

server.listen(3000, () => {
    console.log('Webhook server running on port 3000');
});
```

### Step 6: Configure GitHub Webhook
1. Go to your GitHub repository → Settings → Webhooks
2. Click "Add webhook"
3. Payload URL: `http://100.53.28.191:3000/webhook`
4. Content type: `application/json`
5. Secret: (create a random string)
6. Select "Just the push event"
7. Active: ✅
8. Click "Add webhook"

### Step 7: Setup PM2 for Webhook (Recommended)
```bash
# Install PM2
npm install -g pm2

# Start webhook server with PM2
pm2 start webhook-server.js --name "webhook-deploy"

# Save PM2 process
pm2 save
pm2 startup
```

## 🔄 How It Works

### GitHub Actions Method:
1. You push code to GitHub
2. GitHub Actions triggers automatically
3. Actions SSH into your EC2 instance
4. Pull latest code and run deployment commands
5. Restart services

### Webhook Method:
1. You push code to GitHub
2. GitHub sends webhook to your EC2
3. Webhook server receives request
4. Runs deployment script
5. Updates your application

## 🛠️ Deployment Script Features

- ✅ Pulls latest code from GitHub
- ✅ Installs/updates composer dependencies
- ✅ Builds frontend assets
- ✅ Clears all Laravel caches
- ✅ Sets proper file permissions
- ✅ Restarts web services
- ✅ Provides deployment feedback

## 📋 Required GitHub Secrets

| Secret Name | Value |
|-------------|-------|
| `EC2_HOST` | `100.53.28.191` |
| `EC2_USERNAME` | `ec2-user` |
| `EC2_SSH_KEY` | Content of your `test key.pem` file |

## 🚨 Important Notes

1. **Security**: Never commit your private key to Git
2. **Backups**: Always backup your database before deployment
3. **Testing**: Test deployment on staging first
4. **Monitoring**: Monitor deployment logs for errors
5. **Rollback**: Keep previous commits for easy rollback

## 🎯 Next Steps

1. ✅ Create GitHub repository
2. ✅ Add GitHub secrets
3. ✅ Setup EC2 Git connection
4. ✅ Test deployment
5. ✅ Push code and watch auto-deployment!

Now every time you push to GitHub, your EC2 will automatically update! 🎉
