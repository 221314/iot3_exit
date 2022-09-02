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
                result = "SAVE"
            else :  
                result = "FLAME"        # 불꽃 감지시 0을 전송함
            datas = {
            'type': result,
            'val': 0}
            url = "http://localhost/query.php"
            response = requests.post(url)
            print(timestamp, result, response.text)
            time.sleep(1)
    except :
        print("err or Ctrl - C")
    finally :
        GPIO.cleanup()
        print("END")