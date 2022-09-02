import RPi.GPIO as GPIO
import time
import requests

FLAME = 17  # BCM. 17, wPi. 0, Physical. 11(DOUT에 연결)

GPIO.setmode(GPIO.BCM)
GPIO.setup(FLAME, GPIO.IN)

if __name__ == "__main__" :
    try :
        while(1) :

            now = time.localtime()
            timestamp = ("%04d-%02d-%02d %02d:%02d:%02d" % 
            (now.tm_year, now.tm_mon, now.tm_mday, 
            now.tm_hour, now.tm_min, now.tm_sec))

            if GPIO.input(FLAME) == 1 : # 평소 1을 전송함
                userdata = {'type':'fire_sensor', 'val': 'SAVE' }
                url = 'http://192.168.1.242/query.php'
                resp = requests.post(url, data=userdata, verify=False)
                print (timestamp,resp,resp.text)
                time.sleep(1.5)
                
            else :  
                result = "FLAME"        # 불꽃 감지시 0을 전송함
                userdata = {'type':'fire_sensor', 'val': 'FLAME' }
                url = 'http://192.168.1.242/query.php'
                resp = requests.post(url, data=userdata, verify=False)
                print (timestamp,resp,resp.text)
                time.sleep(1.5)
    except :
        print("err or Ctrl - C")
    finally :
        GPIO.cleanup()
        print("END")