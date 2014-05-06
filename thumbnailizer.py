"""
Made by M@D$K!LLZ
2014.04.08 02:51
command in terminal: thumbnailizer.py ABSOLUTE_PATH_TO_IMAGES_FOLDER
this creates a 'thumbnails' folder with thumbnailized jpeg images with ascending numerical names in this script's directory
requires python PIL library
"""
import os
import sys
import Image
from datetime import datetime as dt

def thumbnailize(path, iname, nname):
    img = Image.open(path + iname)    
    img.thumbnail((192, 192), Image.ANTIALIAS)
    img.save('thumbnails/' + str(nname) + '.jpg', 'JPEG')

def main():
    startTime = dt.now()	
    nname = 1
    path = sys.argv[1] + '/'
    images = os.listdir(path)
	
    os.mkdir('thumbnails')

    for name in images:
        if name.endswith('.jpg'):
            thumbnailize(path, name, nname)
            nname+=1
	
    print 'done in', dt.now()-startTime, 'seconds.'
    print 'generated', nname-1, 'thumbnails.'

if __name__ == "__main__":
    main()