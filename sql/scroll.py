import pyautogui
import time

print(pyautogui.size())
# pyautogui.moveTo(100, 100, duration = 1)
# pyautogui.click(100, 100)

time.sleep(20)

while(True):
     
    # pyautogui.scroll(200)
    pyautogui.moveTo(500, 500, duration = 1)
    time.sleep(3)
    pyautogui.moveRel(500, 0, duration = 1)
    time.sleep(3)