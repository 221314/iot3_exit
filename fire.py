import RPi.GPIO as GPIO
import time
import requests

GPIO.setmode(GPIO.BCM)

FLAME = 20
LED = 26

GPIO.setup(FLAME, GPIO.IN)
GPIO.setup(LED, GPIO.OUT)

try :

     while True :

          flame=GPIO.input(FLAME)

          if flame==0 :

                 GPIO.output(LED,GPIO.HIGH)
                 print("fire detect")
                 
                 userdata = {'type':'fire', 'val': [flame] }
                 url = 'http://192.168.1.242/query.php'
                 resp = requests.post(url, data=userdata, verify=False)
                 print ("result : ", resp)
                 
                 time.sleep(1.5)

          else :

                  GPIO.output(LED,GPIO.LOW)
                  print("safe")
                  userdata = {'type':'fire', 'val': [flame] }
                  url = 'http://192.168.1.242/query.php'
                  resp = requests.post(url, data=userdata, verify=False)
                  print ("result : ", resp)
                 
                  time.sleep(1.5)

finally :

       GPIO.cleanup()
