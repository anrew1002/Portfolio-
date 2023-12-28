from dis import Positions
from math import radians
from os import name
import random
from turtle import pos, position
import cv2
from matplotlib import contour
from matplotlib.pylab import rand

cv2.namedWindow("Camera", cv2.WINDOW_KEEPRATIO)
cam = cv2.VideoCapture(0)

position = (10, 10)
ret, frame = cam.read()
# frame = frame[:, ::-1]
frame = cv2.GaussianBlur(frame, (21, 21), 0)
hsv_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)

bgr = frame[position[1] - 2:position[1] +
            3, position[0] - 2:position[0]+3]
hsv = hsv_frame[position[1] - 2:position[1] +
                3, position[0] - 2:position[0]+3]


# orang BGR=68, 130, 234, HSV=11,180,234
# (311, 212)
# blue BGR=68, 130, 234, HSV=10,199,232
# (311, 212)
# green BGR=185, 132, 67, HSV=103,161,185


def on_mouse_click(event, x, y, flags, param):
    if event == cv2.EVENT_LBUTTONDOWN:
        global position
        position = (x, y)
        print(position)

        bgr = frame[position[1] - 2:position[1] +
                    3, position[0] - 2:position[0]+3]
        hsv = hsv_frame[position[1] - 2:position[1] +
                        3, position[0] - 2:position[0]+3]
        b, g, r = int(bgr[:, :, 0].mean()), int(
            bgr[:, :, 1].mean()), int(bgr[:, :, 2].mean())

        h, s, v = int(hsv[:, :, 0].mean()), int(
            hsv[:, :, 1].mean()), int(hsv[:, :, 2].mean())
        print(f"BGR={b}, {g}, {r}, HSV={h},{s},{v}")
        print(ball_names)


cv2.setMouseCallback("Camera", on_mouse_click)  # type: ignore

lower = (0, 0, 0)
upper = (255, 255, 255)

balls = [{"name": "orange", "hsv": [11, 180, 234], "bgr": [68, 130, 234]},
         {"name": "blue",   "hsv": [103, 172, 229], "bgr": [253, 179, 87]},
         {"name": "green",  "hsv": [62, 117, 149], "bgr": [85, 149, 80]}]

cur_ball_names = ["orange", "blue", "green"]
random.shuffle(cur_ball_names)
print(cur_ball_names)


def findBall(frame, hsv_frame, bgr, hsv):
    # b, g, r = int(bgr[:, :, 0].mean()), int(
    #     bgr[:, :, 1].mean()), int(bgr[:, :, 2].mean())

    # h, s, v = int(hsv[:, :, 0].mean()), int(
    #     hsv[:, :, 1].mean()), int(hsv[:, :, 2].mean())
    x, y = -100, -100
    b, g, r = bgr
    h, s, v = hsv

    lower = (h * 0.9, s * 0.5, v * 0.3)
    upper = (h * 1.1, 255, 255)

    mask = cv2.inRange(hsv_frame, lower, upper)  # type: ignore
    mask = cv2.dilate(mask, None, iterations=2)  # type: ignore
    cnts = cv2.findContours(mask, cv2.RETR_EXTERNAL,
                            cv2.CHAIN_APPROX_SIMPLE)[0]
    if len(cnts) > 0:
        c = max(cnts, key=cv2.contourArea)
        (x, y), radius = cv2.minEnclosingCircle(c)
        if radius > 35:
            cv2.circle(frame, (int(x), int(y)), int(radius), (b, g, r), -1)
            return mask, (x, y)
    return mask, None


ball_names = []
while cam.isOpened():
    ret, frame = cam.read()
    # frame = frame[:, ::-1]

    frame = cv2.GaussianBlur(frame, (21, 21), 0)
    hsv_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2HSV)

    mask1, cO = findBall(frame, hsv_frame, balls[0]["bgr"], balls[0]["hsv"])
    mask2, cB = findBall(frame, hsv_frame, balls[1]["bgr"], balls[1]["hsv"])
    mask3, cG = findBall(frame, hsv_frame, balls[2]["bgr"], balls[2]["hsv"])

    cv2.circle(frame, position, 8, (255, 125, 255))
    # cv2.circle(frame, position, 5, (b, g, r), 2)
    if cO is not None and cB is not None and cG is not None:
        result = [{"name": "orange", "value": cO},
                  {"name": "blue", "value": cB},
                  {"name": "green", "value": cG}
                  ]
        result.sort(key=lambda c: c["value"][0])

        ball_names = [res["name"] for res in result]
        if ball_names == cur_ball_names:
            # print("yea!")
            cv2.putText(frame, "Good human!", (10, 50),
                        cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 255, 0), 2)

    cv2.imshow("Mask", mask1)
    cv2.imshow("Camera", frame)

    key = cv2.waitKey(1)
    if key == ord('q'):
        break

        # print(ball_names)
        # print("\n")


cam.release()
cv2.destroyAllWindows()
