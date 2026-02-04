@echo off
git add .
git commit -m "Auto deploy"
git push origin master
ssh -i "test key.pem" ec2-user@ammar.mi3afzal.com "cd /var/www/laravel && sudo ./deploy.sh"
echo ✅ Auto deployed!
