import sys
import os
from PyQt5.QtWidgets import *
from PyQt5.QtGui import *
from PyQt5.QtCore import *
from PyQt5 import uic

from multiprocessing import Process, Queue
import multiprocessing as mp
import datetime
import time

import requests

# https://wikidocs.net/87141
# 큐(Queue)를 사용해서 프로세스 간의 데이터 전달을 처리

def producer(q): #어떤 데이터를 생상하는 역할, 데이터가 생성되면 큐에 넣어주기만 합니다.
    proc = mp.current_process()
    print(proc.name)

    while True: #데이터생성
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
        time.sleep(1)

def mjpg():
    os.system('mjpg_streamer -i "input_uvc.so -d /dev/video0" -o "output_http.so -p 8090 -w /usr/local/share/mjpg-streamer/www/"')

class Consumer(QThread): #큐에 데이터가 입력되면 데이터를 큐에서 빼옵니다. 
                         #데이터를 PyQt와 같은 GUI 담당 스레드에게 전달
    poped = pyqtSignal(str)

    def __init__(self, q):
        super().__init__()
        self.q = q

    def run(self):
        while True:
            if not self.q.empty(): #'q'가 비어있지 않다면
                data = q.get() #'q'에서 데이터를 꺼내온다.
                self.poped.emit(data)

# class MyWindow(QMainWindow):
#     def __init__(self, q):
#         super().__init__()
#         self.setGeometry(200, 200, 300, 200) #창 출력 위치(좌표,사이즈)

form_main = uic.loadUiType("mw.ui")[0] #ui 파일 불러오기

class MainWindow(QMainWindow,form_main):
    def __init__(self):
        super().__init__()
        self.initUI()
#        self.show()

    def initUI(self):
        self.setupUi(self)
        self.defaultPic()

        # thread for data consumer = Q데이터를 받고 스레드 실행
        self.consumer = Consumer(q)
        self.consumer.poped.connect(self.print_data) #시그널?
        self.consumer.start()
        
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
    def print_data(self, data):
        self.statusBar().showMessage(data)
        if data == "abn_acc":
            self.buttonClicked()
        if data == "abn_fire":
            self.buttonClicked2()
        if data == "abn_sensor":
            self.buttonClicked3()
        # if data == "null":
        #     self.defaultPic() #디폴트 화면으로 돌아가는거 어떻게 표현하지? 

if __name__ == "__main__":
    q = Queue()

    # producer process
    p = Process(name="producer", target=producer, args=(q, ), daemon=True)
    p_mjpg = Process(name="mjpg", target=mjpg, args=(),daemon=True)
    p.start()
    p_mjpg.start()
    # Main process : GUI를 위한 스레드와 Consumer를 위한 스레드(소비자는 큐를 보고있어야해서)
    # app = QApplication(sys.argv)
    # mywindow = MyWindow(q)
    # mywindow.show()
    # app.exec_()

    app = QApplication(sys.argv)
    win = MainWindow()
    #win.showFullScreen() #전체화면으로 열기
    win.show()
    sys.exit(app.exec_())