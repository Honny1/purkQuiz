# -*- coding: utf-8 -*-

import random
import time
import logging

from selenium import webdriver
from selenium.webdriver.common.keys import Keys
#from selenium.webdriver.firefox.firefox_binary import FirefoxBinary #uncomment this for use firefox

#binary = FirefoxBinary('/usr/bin/firefox') #uncomment this for use firefox


class QuizBot(object):
    def __init__(self, name="HAJI"):
        self.name = name
        print("Hi, my name is {}".format(self.name))
        self.d = {1:"A", 2:"B", 3:"C", 4:"D"}
        #self.driver = webdriver.Firefox(firefox_binary=binary) #uncomment this for use firefox
        self.driver = webdriver.Chrome() #new Window
        self.driver.get("https://quiz.buchticka.eu/?username=bot{}".format(self.name)) #open url
        self.startPlay() #start quiz

    def startPlay(self):
        """ this method start the quiz by clicking an PLAY button"""
        self.htmlButton = self.driver.find_element_by_id("play") # identify play button
        self.htmlButton.click()
        time.sleep(2) # we must wait while page content get changed
        self.vote()

    def vote(self):
        """ this method voting in the quiz"""
        self.questionNumber = 1 # variable for console log
        while True:
            try:
                self.randomChoose = self.d[random.randint(1,4)] # variable for vote and console log
                self.htmlButtonInGame = self.driver.find_element_by_id(self.randomChoose) # identify answer button
                self.htmlButtonInGame.click()
                self.waitToNext = random.randint(2,8)
                print("Question: {}; Choosen: {} Waiting: {}".format(self.questionNumber, self.randomChoose, self.waitToNext)) # printing some log to console
                time.sleep(self.waitToNext)#2.0875) # we must wait while page content get changed
                self.questionNumber += 1
            except Exception as e:
                if not "no such element" in str(e): # this conditial will happen everytime, when the bot voted for every questions
                    print("{}`s Problem:\n{}".format(self.name, e)) # print what is wrong
                time.sleep(0.0875)
                self.save() # save bot´s score to databse
                break # we must break cycle, because it will be broken, if we didn´t stop that
    
    def save(self):
        try:
            self.htmlButtonSave = self.driver.find_element_by_id("saveMyShit") # identify save button
            self.htmlButtonSave.click()
            time.sleep(2) # we must wait while page content get changed
            self.score = float(self.driver.find_element_by_id("score").text)
            print("Bot {} scored {}".format(self.name, self.score))
        except Exception as e:
            print("{}`s Problem:\n{}".format(self.name, e)) # print what is wrong
        finally:
            self.driver.quit() # close driver
            print("Bot {} has finished his work!".format(self.name)) # console log

botNames = {1:"HAJI", 2:"ZEMI", 3:"KOFR", 4:"ZAJA", 5:"CHIV", 6:"TODA", 7:"PEPE", 8:"DAMI", 9 : "KLJA", 10:"JIDA", 11:"HORA", 12:"HATA", 13:"SVJA", 14:"BENA"}
i = 0
while True:
    i += 1
    bot = QuizBot(botNames[random.randint(1, 14)])
    #time.sleep(5)
    print("Cycle run {}x\n".format(i))
#bot = QuizBot()
