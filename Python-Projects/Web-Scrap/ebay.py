import requests



from bs4 import BeautifulSoup
import pandas as pd

#driver = webdriver.Chrome("/usr/lib/chromium-browser/chromedriver")
#driver = webdriver.Chrome(executable_path='/usr/local/bin/chromedriver')

data=requests.get('https://www.ebay.com/sns?store_search=marine')
#print(data.content)

namesList=[] #List to store name of the product
followersList=[] #List to store price of the product
ratings=[] #List to store rating of the product

#content = driver.page_source
soup = BeautifulSoup(data.content, features="html.parser")
for a in soup.findAll('li', attrs={'class':'sns-item'}):
	#print(a)
	url=a.find('a', href=True)
	print(url)
	#print(url['href'])
	detailData=requests.get(url['href'])
	#print(detailData.content)
	op = BeautifulSoup(detailData.content, features="html.parser")
	name=op.find('h1', attrs={'class':'str-billboard__title'})
	followers=op.find('span', attrs={'class':'str-metadata__followers-number'})
	print(name)
	if name:
		namesList.append(name.text)
	else:
		namesList.append('No Data')


	if followers:
		followersList.append(followers.text)
	else:
		followersList.append('No Data')

df = pd.DataFrame({'Name':namesList,'Followers':followersList}) 
df.to_csv('ebay.csv', index=False, encoding='utf-8')
