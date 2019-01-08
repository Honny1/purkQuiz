<<<<<<< HEAD
# Quiz
[Buchtička](https://buchticka.eu) Quiz: The Best Kahoot Alternative

## How to setup
- Install xampp on Windows or Fedora (Apache+php+mysql)
- Clone this repository
    + You can just clone it into htdocs (/var/www/html), not officially supported
    + We recommend making a virtualhost called quiz._example.com_ in folder htdocs/quiz._example.com_ (in case you use Windows) or make a folder in /var/www (if you use Linux)
      (more info on https://httpd.apache.org/docs/2.4/vhosts/examples.html)
- edit credentials in _/controlDatabase/dbConnect.php_
- Go to _/setup_
    + Modify DB server's credentials in _/setup/dbCredentials.php_
    + Use your browser to open: _yourip:yourport/setup_
    + If everthing is OK then:
        * You have added default settings to database
        * You have to remove the _/setup_ directory manually (for security reasons)
    + If something went wrong, try using google and modifying the original files
        * If you can't find any help on the internet, report your problem in Issues of this repository!

## Admin section
- Open _yourip:yourport/admin_ 
- Default login: admin
- Default password: admin
- Can be changed in the database (stored as plaintext)

## Bot for quiz
- Install Python 3
```
sudo pip install -r requirements.txt
```
- Go to _/\_bot/_  and run
```
python run.py
```
=======
Hello world!
>>>>>>> 8ff34e1... Add README.md
