import pyautogui
import time
from inputimeout import inputimeout
import random

# print(pyautogui.size())
# pyautogui.moveTo(100, 100, duration = 1)
# pyautogui.click(100, 100)
# pyautogui.scroll(200)

width,height = pyautogui.size()

def percent(per,hw):
    return int((hw/100)*per)

while(True): 
    try:
        pyautogui.moveTo(percent(35,width), percent(95,height), duration = 1)
        pyautogui.click(percent(35,width), percent(95,height))
        inp = inputimeout(timeout=3)
        # print(inp)
        if inp:
            exit(1)
    except Exception:
        x = random.randint(percent(20,height), percent(80,height))
        pyautogui.moveTo(percent(7,width), x, duration = 1)
        pyautogui.click(percent(7,width), x)
        pyautogui.hotkey('ctrl', 'a')       