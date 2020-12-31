comm = "convert [A]Dirt1_pipo.png +gravity -crop 32x32 16x16_sprite_%d.png"

import subprocess
import os
import shutil
import time

pm_fol = "C://Users/Rojit/Desktop/test"

pm = os.listdir(pm_fol)

for p in pm:
	print(p)
	fp = p[0:p.index(".")]
	fol = "C://xampp/htdocs/PixtileMapMaker/pixshelded/pixshelded/"+fp
	px = os.listdir(fol)[0][0:os.listdir(fol)[0].index("x")]
	print(fol,px)
	if os.path.exists(pm_fol+"/"+fp) == False:
		os.mkdir(pm_fol+"/"+fp)
		shutil.move(pm_fol+"/"+p,pm_fol+"/"+fp)
		com = ["C:/Program Files/ImageMagick-7.0.10-Q16-HDRI/convert",p,"+gravity","-crop",px+"x"+px,px+"x"+px+"_sprite_%d.png"]
		subprocess.Popen(com,cwd=pm_fol+"/"+fp)
		time.sleep(5)
		os.remove(pm_fol+"/"+fp+"/"+p)