import sys
from PyQt5.QtWidgets import *
from PyQt5.QtGui import *
from PyQt5.QtCore import QCoreApplication
from PyQt5 import uic

form_main = uic.loadUiType("mw.ui")[0] #ui 파일 불러오기

#test에 바로 실행시킬 파일명을 입력하면 됨

class MainWindow(QMainWindow,QWidget,form_main):
    def __init__(self):
        super().__init__()
        self.initUI()
        self.show()

    def initUI(self):
        self.setupUi(self)
        img = QPixmap("3.jpg")
        self.pic_label.setPixmap(QPixmap(img))
        self.pushButton.clicked.connect(self.buttonClicked)
        self.pushButton_2.clicked.connect(self.buttonClicked2)
        self.pushButton_3.clicked.connect(self.buttonClicked3)
        self.pushButton_4.clicked.connect(QCoreApplication.instance().quit)

    def buttonClicked(self):
        img = QPixmap("CPR.jpg")
        #img.scaled(QSize(100,100))
        self.pic_label.setPixmap(QPixmap(img))
    
    def buttonClicked2(self):
        img = QPixmap("ff.jpg")
        self.pic_label.setPixmap(QPixmap(img))

    def buttonClicked3(self):
        img = QPixmap("ex.jpg")
        self.pic_label.setPixmap(QPixmap(img))

if __name__ == "__main__":
    app = QApplication(sys.argv)
    win = MainWindow()
    win.showFullScreen()
    sys.exit(app.exec_())
