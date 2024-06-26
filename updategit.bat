@echo off
cd /d %~dp0
echo ------------------------
echo Do you want this Repo
echo with version code 3.30?
echo ------------------------
pause
git add .
git commit -m "3.30"
git push -u origin main
pause