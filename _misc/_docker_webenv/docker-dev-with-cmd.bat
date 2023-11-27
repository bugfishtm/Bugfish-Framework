REM Script to initialize this docker Environment and run a command in the container after it!
docker compose -f ./docker-dev.yml up -d software
@echo off
setlocal

REM Define the name of the Docker container you want to wait for
set CONTAINER_NAME=SETCONTAINERNAME

:WAIT_LOOP
REM Check if the container is running
docker ps -a --format "{{.Names}}" | findstr /i /c:"%CONTAINER_NAME%" >nul
if %errorlevel% equ 0 (
    echo Container '%CONTAINER_NAME%' is running, executing the command...
    
    REM Execute your desired command inside the container
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    REM docker exec -it %CONTAINER_NAME% YOURCOMMAND
    
	pause
    REM Exit the script
    exit /b 0
)

echo Waiting for container '%CONTAINER_NAME%' to start...
timeout /t 5 /nobreak >nul
goto :WAIT_LOOP

endlocal
pause