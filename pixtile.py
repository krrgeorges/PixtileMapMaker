import os


def match_assert():
	root = "C://xampp/htdocs/PixtileMapMaker/pixshelded"

	pixfol = root+"/pixshelded"
	piximgs = root+"/pixshelded_match"

	fpixfol = os.listdir(pixfol)
	fpiximgs = os.listdir(piximgs)

	for i in range(len(fpixfol)):
		if fpixfol[i] != fpiximgs[i].replace(".png","").replace(".gif","").replace(".jpg",""):
			print(fpixfol[i],"didnt match",fpiximgs[i].replace(".png","").replace(".gif","").replace(".jpg",""))