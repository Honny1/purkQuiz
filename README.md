# Quiz
[Buchtička](https://buchticka.eu) Quiz: The Best Kahoot Alternative

## How to setup
- Clone this repository
- edit credentials in file _/controlDatabase/dbconnect.php_
- edit _/globalVar/variables.php_
- Go to _/setup_
    + edit database server credentials in file _/setup/dbCredentials.php_
    + open in your browser _yourip:yourport/setup_
    + If is everthing OK
        * You have added default settings to database
        * !!! We recommend delete folder _/setup_ !!!
    + If something went wrong try solve that with Google.com
        * If don`t help, report your problem in Issues of this repository!

## Admin section
- Open in your browser _/admin_ and login with admin and admin

## Bot for quiz
- Install Python 3
```
sudo pip install -r requirements.txt
```
- Go to _/\_bot/_  and run
```
python run.py
```