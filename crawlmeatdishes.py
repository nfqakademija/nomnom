"""
Urls from meat dish category 
"""
import urllib
import socket
socket.setdefaulttimeout(10)
import re

from datetime import datetime as dt
from operator import itemgetter

url = 'http://recipes.wikia.com/wiki/Category:Main_Dish_Meat_Recipes?title=Category:Main_Dish_Meat_Recipes&page=';


def get_page(url):
        try:
            f = urllib.urlopen(url)
            page = f.read()
            f.close()
            return page
        except:
            return ""
        return ""

def get_next_target(page):
        start_link = page.find('<a href=')
        if start_link == -1:
            return None, 0
        start_quote = page.find('"', start_link)
        end_quote = page.find('"', start_quote + 1)
        url = page[start_quote + 1:end_quote]
        return url, end_quote
def union(p,q):
        cnt = 0
        for e in q:
            if e not in p:
                p.append(e)
                cnt += 1
        return cnt
def get_all_links(page):
        links = []
        while True:
            url,endpos = get_next_target(page)
            if url:
                links.append(url)
                page = page[endpos:]
            else:
                break
        return links

startTime = dt.now()		
count = 0
all_links = []		
for x in range (1,31):
    page = get_page(url+str(x))	
    links = get_all_links(page)
    union (all_links, links)

for e in all_links:
    if e.find('http://recipes.wikia.com/wiki/') > -1 and e.find('Category') == -1:
        print e
        count +=1
print 'Script took', dt.now()-startTime, 'seconds to run'
print 'Printing ', count, 'urls' 