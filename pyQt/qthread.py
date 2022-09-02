import sys
import os
from PyQt5.QtWidgets import *
from PyQt5.QtGui import *
from PyQt5.QtCore import *
from PyQt5 import uic

from queue import Queue
import threading
import time
import requests

# 스레드는 프로세스(프로그램이 메모리에 올라가 실행중인 상태)의 실행 단위이며 프로세스는 하나 이상의 스레드를 갖는다.
# 스레드는 한 프로세스 안에 여러개 정의(멀티스레드)될 수 있으며 스케쥴링(OS가 관리함. 동시처럼 느껴지게 동작)된다.
# 스레드는 기본적으로 while 무한루프와 QThreadsleep 딜레이로 이루어진다.
class PutWorker(QThread):
    def __init__(self,q):
        super().__init__()
        self.q = q
# run ..... QThread의 메서드 이름(내장함수) ..... 그래서 따로 호출하지 않아도 Q스레드가 호출되면 호출됨.
# class(QThread) 하나당 스레드 하나. 멀티스레딩 = 클래스(init, run 함수 포함) 여러개 만들어야함.
# 만약 run 내장함수를 사용하지않고 직접 만든 함수를 사용하려면 init에서 호출한다.
    def run(self): #어떤 데이터를 생상하는 역할, 데이터가 생성되면 큐에 넣어주기만 합니다.
        while 1: #데이터생성
            # print('dataput work')
            # now = datetime.datetime.now()
            # data = str(now)
            # q.put(data)
            # time.sleep(1)
            url = "http://localhost/abn.php"
            response = requests.post(url)
            t = response.text
            t = t.strip("[""]").replace("\"","").split(",")
            for idx in range(len(t)):
                if t[idx] not in 'null': #null이 아님=이상감지 된 경우
                    #globals()['abn{}'.format(idx)] = t[idx] #리스트를 변수로 분리
                    abn = t[idx]
                    break
                else:
                    abn = 'null'
            q.put(abn) # 'q'에 데이터를 넣어준다.
            # self.timeout.emit(self.q) # 연결된 슬롯에 data를 방출(emit)한다. = 연결된 슬롯을 호출함 ()를 비우면 그냥 호출..
            time.sleep(1)
            
class GetWorker(QThread):
    timeout = pyqtSignal(str) # 사용자 정의 시그널
    def __init__(self,q):
        super().__init__()
        self.q = q

    def run(self):
        while 1:
            if not self.q.empty():  #'q'가 비어있지 않다면
                data = q.get()      #'q'에서 데이터를 꺼내온다.
                self.timeout.emit(data)   # 연결된 슬롯에 data를 방출(emit)한다. = 연결된 슬롯을 호출함 ()를 비우면 그냥 호출
            time.sleep(1)

class MjpgWorker(QThread):
    def __init__(self):
        super().__init__()
    def run(self):
        os.system('mjpg_streamer -i "input_uvc.so -d /dev/video0" -o "output_http.so -p 8090 -w /usr/local/share/mjpg-streamer/www/"')

form_main = uic.loadUiType("mw.ui")[0] #ui 파일 불러오기

class MainWindow(QMainWindow,form_main):
    def __init__(self):
        super().__init__()
        self.initUI()

    def initUI(self):
        print('win init!')
        self.setupUi(self)
        self.defaultPic()

        self.putworker = PutWorker(q)
        self.getworker = GetWorker(q)
        self.mjpgworker = MjpgWorker()
        self.putworker.start()     # QThread 클래스가 가지고 있는 start() 메서드 호출 = 매개함수들 동작함 = running true
        self.getworker.start()
        self.mjpgworker.start()
        self.getworker.timeout.connect(self.timeout)   # 시그널 슬롯 등록

        #버튼 입력시 이벤트
        self.pushButton.clicked.connect(self.buttonClicked)
        self.pushButton_2.clicked.connect(self.buttonClicked2)
        self.pushButton_3.clicked.connect(self.buttonClicked3)
        #quit 버튼(창닫기)
        self.pushButton_4.clicked.connect(QCoreApplication.instance().quit)

    def defaultPic(self):
        img = QPixmap("3.jpg") #디폴트 대기화면
        self.pic_label.setPixmap(QPixmap(img))

    def buttonClicked(self): #심폐소생술
        img = QPixmap("CPR.jpg")
        #img.scaled(QSize(100,100))
        self.pic_label.setPixmap(QPixmap(img))
    
    def buttonClicked2(self): #소화기 사용방법
        img = QPixmap("ff.jpg")
        self.pic_label.setPixmap(QPixmap(img))

    def buttonClicked3(self): #피난도
        img = QPixmap("ex.jpg")
        self.pic_label.setPixmap(QPixmap(img))

    @pyqtSlot(str) #시그널(이벤트)핸들. 실시간 처리할 이벤트?
    def timeout(self, data):
        self.statusBar().showMessage(data)
        if data == "abn_acc":
            self.buttonClicked()
        if data == "abn_fire":
            self.buttonClicked2()
        if data == "abn_sensor":
            self.buttonClicked3()
        # if q == "null":

if __name__ == "__main__":
    q = Queue()

    app = QApplication(sys.argv)
    win = MainWindow()
    win.show()
    sys.exit(app.exec_())