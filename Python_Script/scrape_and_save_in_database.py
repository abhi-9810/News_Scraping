import requests
from bs4 import BeautifulSoup
import MySQLdb
import ssl
#ssl._create_default_https_context = ssl._create_unverified_context
db = MySQLdb.connect("","","","" )
cursor = db.cursor()

requests.packages.urllib3.disable_warnings()
context = ssl.SSLContext(ssl.PROTOCOL_TLSv1)
context.verify_mode = ssl.CERT_NONE

r=requests.get("https://www.ndtv.com/topic/road-safety", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_link=soup.find_all("p",class_="header fbld",limit=20)
header_credits=soup.find_all("p",class_="list_dateline",limit=20)
header_contents=soup.find_all("p",class_="intro",limit=20)
header_img=soup.find_all("p",class_="float_l fa fs12 fb lh16 mart15 marb5 lh18 fcg",limit=20)
j=0
cursor.execute("TRUNCATE news_data")
for i in range(0,20):
    try:
        link=header_link[i].select("a")
        news_heading=str(link[0].contents[0].contents[0])
        link_news=str(link[0].get("href"))

        credits1=header_credits[i].contents[0]
        img_src=str(header_img[i].select("img")[0].get("src"))

        content=str(header_contents[i].contents[0])
        try:
            credits1=credits1.strip()
        except:
            pass
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,content.strip(),link_news,credits1,"ndtv")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break
    except:
        print("w\n\n\n")
        pass


r=requests.get("https://indianexpress.com/about/road-safety/", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_all=soup.find_all("div",class_="details",limit=15)
j=0
for i in range(0,15):
    try:
        header=header_all[i]
        temp=header.select("div")
        link_news=str(temp[0].select("a")[0].get("href"))
        img_src=str(temp[0].select("a")[0].select("img")[0].get("data-lazy-src"))
        temp=header.select("h3")
        news_heading=str(temp[0].select("a")[0].contents[0])
        temp=header.select("p")
        contents=str(temp[0].contents[0]).encode('cp1252')
        credits1=header.select("time")[0].contents[0]
        temp=header.select("time")[0].select("a")
        if(len(temp)!=0):
            credits1=temp
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,contents,link_news,credits1,"indianexpress")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break            
    except Exception as e:
        print(e)
        print("w\n\n\n")
        pass            
r=requests.get("https://theconversation.com/global/topics/road-safety-1104", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_all=soup.find_all("div",class_="content-list")[0]
j=0
for i in range(0,20):
    try:
        header=header_all.select("article")[i]
        temp=header.select("figure")[0]
        link_news=str(temp.select("a")[0].get("href"))
        link_news='https://theconversation.com'+link_news
        img_src=str(temp.select("a")[0].select("img")[0].get("data-src"))
        news_heading=str(temp.select("figcaption")[0].select("span")[0].contents[0]).strip()
        temp=header.select("div")
        contents=str(temp[1].select("span")[0].contents[0])
        temp1=temp[0].select("p")[0].select("span")[0].contents
        credits1=str(temp1[0])+str(temp1[1])
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,contents,link_news,credits1,"theconversation")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break            
    except Exception as e:
        print(e)
        print("w\n\n\n")
        pass

r=requests.get("http://zeenews.india.com/tags/road-safety.html", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_all=soup.find_all("section",class_="maincontent")[0]
j=0
for i in range(0,20):
    try:
        header=header_all.select("div")[2*i]
        temp=header
        link_news=str(temp.select("a")[0].get("href"))
        img_src=str(temp.select("a")[0].select("img")[0].get("src"))
        news_heading=str(temp.find_all("div",class_="sec-con-box")[0].select("a")[1].contents[0])
        contents=str(temp.find_all("div",class_="sec-con-box")[0].select("p")[1].contents[0])
        credits1="zeenews"
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,contents,link_news,credits1,"zeenews")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break            
    except Exception as e:
        print(e)
        print("w\n\n\n")
        pass

print("-------------------------------------------------------------------------------------------------------")
r=requests.get("https://www.news18.com/newstopics/road-safety.html", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_all=soup.find_all("div",class_="search-listing")[0]
j=0
for i in range(0,20):
    try:
        header=header_all.select("ul")[1].select("li")[i]
        temp=header
        link_news=str(temp.select("h2")[0].select("a")[0].get("href"))
        img_src=str(temp.select("a")[0].select("img")[0].get("src"))
        news_heading=str(temp.select("h2")[0].select("a")[0].contents[0])
        contents=str(temp.select("p")[0].select("a")[0].contents[0])
        credits1="news18"
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,contents,link_news,credits1,"news18")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break            
    except Exception as e:
        print(e)
        print("w\n\n\n")
        pass
"""        
print("-------------------------------------------------------------------------------------------------------")
r=requests.get("https://auto.economictimes.indiatimes.com/tag/road+safety", verify=False)
html=r.content
soup = BeautifulSoup(html, 'html5lib')
header_all=soup.find_all("div",class_="story_list")[0]
j=0
for i in range(0,17):
    try:
        header=header_all.select("div")[5*i]
        temp=header
        link_news=str(temp.select("h4")[0].select("a")[0].get("href"))
        img_src=str(temp.select("div")[0].select("a")[0].select("img")[0].get("src"))
        news_heading=str(temp.select("h4")[0].select("a")[0].contents[0])
        contents=str(temp.select("div")[1].select("p")[0].contents[0])
        credits1="economictimes"
        query = "INSERT INTO news_data(heading,img_src,content,news_link,credits,news_channel) " \
            "VALUES(%s,%s,%s,%s,%s,%s)"
        args = (news_heading,img_src,contents,link_news,credits1,"economicstimes")
        cursor.execute(query, args)
        j+=1
        if(j==10):
            break            
    except Exception as e:
        print(e)
        print("w\n\n\n")
        pass
"""        
db.close()
