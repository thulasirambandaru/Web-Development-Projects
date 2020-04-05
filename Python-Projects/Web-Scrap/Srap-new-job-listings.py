import datetime
import requests
from bs4 import BeautifulSoup, NavigableString, Tag
import pandas as pd		

# INPUTS / PATTERN for the scrapping

inputData = {"mudah": {"site_url":"https://www.mudah.my/malaysia/Jobs-available-7020", "section":"date_job", 
						"job_name": {"tag":"a", "tag_attr":"job_blk job_f"}, 
						"job_salary":{"tag":"div", "tag_attr":"red_price job_f", "custom_processing":False}, 
						"job_posted":{"tag":"span","tag_attr":"website job_ww job_f","custom_processing":True}
						},
			 "fastjobs": {"site_url":"https://www.fastjobs.my/malaysia-jobs/", "section":"job-post", 
						"job_name": {"tag":"h2", "tag_attr":"visible-xs"}, 
						"job_salary":{"tag":['span','strong'], "tag_attr":"text-primary", "custom_processing":True}, 
						"job_posted":{"tag":"p","tag_attr":"coyinfo","custom_processing":True}
						}
			}


def jobListings():
	for idata in inputData:

		jobName = [] 
		postedDate = [] 
		jobSalary = []

		data=requests.get(inputData[idata]['site_url'])
		results = BeautifulSoup(data.content, features="html.parser", from_encoding="iso-8859-1")

		for res in results.findAll('div', attrs={'class':inputData[idata]['section']}):

			if inputData[idata]['job_posted']['custom_processing']:
				postedVal = res.find(inputData[idata]['job_posted']['tag'], attrs={'class':inputData[idata]['job_posted']['tag_attr']})
				currentDate = getCurrentDate(siteName=idata, postedVal=postedVal)
			else:
				currentDate = res.find(inputData[idata]['job_posted']['tag'], attrs={'class':inputData[idata]['job_posted']['tag_attr']})

			if currentDate:

				name = res.find(inputData[idata]['job_name']['tag'], attrs={'class':inputData[idata]['job_name']['tag_attr']}).text

				if inputData[idata]['job_salary']['custom_processing']:
					salaryVal = res.findAll(inputData[idata]['job_salary']['tag'], attrs={'class':inputData[idata]['job_salary']['tag_attr']})
					salary = None
					salaryResult = getSalary(siteName=idata, salaryVal=salaryVal)
					if salaryResult:
						salary = salaryResult.text
				else:
					salary = res.find(inputData[idata]['job_salary']['tag'], attrs={'class':inputData[idata]['job_salary']['tag_attr']}).text		

				jobName.append(name)
				postedDate.append(currentDate)
				jobSalary.append(salary)

		
			dframe = pd.DataFrame({'Job Title':jobName,'Salary':jobSalary,'Posted':postedDate}) 
			dframe.to_csv(idata+'.csv', index=False, encoding='utf-8')



# Utility Methods

def getCurrentDate(siteName=None, postedVal=None):
	""" This method will parse the input and return the current date """
	result = None
	if siteName == "mudah":
		if postedVal:
			if "Today" in postedVal.text:
				result = datetime.datetime.today().date()
	elif siteName == "fastjobs":
		if postedVal:
			for posted in postedVal:
				if isinstance(posted, NavigableString):
					dateval = str(posted).replace('Posted on ','').strip()		
					datestr = dateval+' '+str(datetime.date.today().year) # The date - 29 Dec 2017
					formatstr = '%d %b %Y' # The format
					datetimeobj = datetime.datetime.strptime(datestr, formatstr)
					if datetime.datetime.today().date() == datetimeobj.date():
						result = datetimeobj.date()
	return result
				

def getSalary(siteName=None, salaryVal=None):
	""" This method will parse the input and return the salary """
	result = None
	if siteName == "mudah":
		if "Today" in postedVal.text:
			pass
	elif siteName == "fastjobs":
		if salaryVal:
			result = salaryVal[0].find('strong')
	return result


if __name__ == '__main__':
	jobListings()
		
		