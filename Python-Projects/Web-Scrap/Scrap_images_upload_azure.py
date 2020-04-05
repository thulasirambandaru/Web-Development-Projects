from azure.storage.blob import BlockBlobService, PublicAccess 
from azure.storage.blob.models import Blob, ContentSettings
import urllib.request
import os
import re
import json
from bs4 import BeautifulSoup
from datetime import datetime

def run_sample(dayInterval):

    block_blob_service = BlockBlobService(account_name='pilogimages', account_key='cIOZ9+d9nd7oEsfJ4IlnDSUZwWY09bf37n0ibXmNrFUI7PnIwcCBtQyAo13QFM85IBCdtDvTBQ9lUZpFRLBGhQ==')
    container_name ='images'

    
    response = urllib.request.urlopen("http://<hostname>:<port>/Images")
    #path = 'test-upload.jpg'
    #block_blob_service.create_blob_from_path(container_name, path, path)
    
    soup = BeautifulSoup(response, features="html.parser")
    soup.unicode
    rows = soup.find_all('tr')
        
    for row in rows:    
        data = row.find_all("td")
        if len(data)>0:    
            modDate = data[1].get_text()
            
            now = datetime.now()
            date_format = "%b %d, %Y %H:%M:%S"
            currentDateStr = now.strftime("%b %d, %Y %H:%M:%S")
            
            imageModifiedDate = datetime.strptime(modDate, date_format)
            currentDate = datetime.strptime(currentDateStr, date_format)
            
            difference = currentDate - imageModifiedDate           

            if difference.days < dayInterval:
                name = data[0].find('a').get_text()
                imgSize = data[2].get_text()
                  
                if imgSize != '--':
                    resource = urllib.request.urlopen("http://<hostname>:<port>/Images/"+name)
                    output = open(name,"wb")
                    output.write(resource.read())
                    output.close()
                    block_blob_service.create_blob_from_path(container_name, name, name, 
                                                            content_settings=ContentSettings(content_type="image/jpg"))
                    os.remove(name)
                
    
   # Main method.
if _name_ == '_main_':
    run_sample(10
