import os
try:
    """#os.system("passwd pi")
    #   Make backup file
    os.system("mv /etc/profile.d/sshpwd.sh /etc/profile.d/sshpwd.sh.bak")

    with open("/etc/profile.d/sshpwd.sh", "w") as f:
        f.write("""export TEXTDOMAIN=Linux-PAM     # added by setupRPiForQuiz.py

    . gettext.sh        # added by setupRPiForQuiz.py

    """)"""
    
    #   disable screen saver
    # os.system("sudo apt-get install xscreensaver -y") # old variant
    os.system("cp /etc/lightdm/lightdm.conf /etc/lightdm/lightdm.conf.bak")
    with open("/etc/lightdm/lightdm.conf", "a") as f:
        f.write("""
            # don't sleep the screen    # added by setupRPiForQuiz.py
            xserver-command=X -s 0 dpms""")
    


    # Add my website to autostart as kiosk mode in Chromium <3
    with open("/home/pi/.config/lxsession/LXDE-pi/autostart", "a") as f:
        f.write("@xset s off\n@xset -dpms\n@xset s noblank\n@chromium-browser --kiosk https:\\\\quiz.buchticka.eu/results/marek.php")


    print("All tasks done.")

except Exception as e:
    raise e