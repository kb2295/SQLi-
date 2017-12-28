import time
import urllib
from bs4 import BeautifulSoup

file = open("./payloads.txt").read()
payloads = file.splitlines()

def cleanURL( url, action ):
  if(url.endswith("/") and action.startswith("/")):
    return url[:-1] + action
  elif(not url.endswith("/") and not action.startswith("/")):
    return url + "/" + action
  else:
    return url + action

def elementsToPayload( elements ):
  payload = {}
  for element in elements:
    if(element.has_attr('name')):
      name = element["name"]
    else:
      name = element["id"]
    payload[name] = name
  return payload

def makeRequests( url , data , injection):
  for attr in data:
    data[attr] = injection
  res = urllib.urlopen(url, urllib.urlencode(data)).read()
  if "Success!" in res:
    return False
  else:
    return True

# returns list of failed injections
def analyzeForm( domain , form ):
  method = form.get("method")
  action = form.get("action")
  inputElements = filter(lambda x: x['type'] != "submit", form.find_all("input"))
  print("  "+str(len(inputElements))+" inputs found:")
  payload = elementsToPayload(inputElements)
  for attr in payload:
    print("   "+attr)
  try:
    url = cleanURL(domain, action)
  except:
    print "There was a problem interpreting the request URL. Please contact the developers."
    exit()
  failed = []
  for injection in payloads:
    if(not makeRequests(url, payload, injection)):
      failed.append(injection)
  return failed


# Print welcome and disclaimer
print("Welcome to SQLi detector, a simple web form scanner and SQLi detector for webpages.\n\nDISCLAIMER: We take no responsibility over the use of this application. It is illegal and against the terms of use for this application to use against any domain without excplicit permission form the target site's owner.\n\n")

# Get the URL from the user
url = raw_input("Please enter the URL of the webpage you would like to scan for SQL injections.\n> ")

# Inform the user of the scan and URL
print("Now scanning: "+url)

# Begin scrape
page = urllib.urlopen(url)
soup = BeautifulSoup(page, 'html.parser')

# Get the forms on the page
forms = soup.find_all('form')

print("\n--------------\nForms found: "+str(len(forms))+"\n--------------")
for i in range(len(forms)):
  print("Analyzing form: "+str(i+1))
  failed = analyzeForm(url, forms[i])
  print "Passed "+str(len(payloads) - len(failed))+"/"+str(len(payloads))+" tests."
  if(len(failed) > 0):
    print("  Vulnerable inputs: ")
    for inj in failed:
      print("    "+inj)
  print("\n ------------------------ \n")

















# print("1 form found:\nForm id: login_form\n- Input id: user\n- Input id: pass\nSubmit path: http://www.myvulnerablesite.com/learn/login.ajax.php\n\nTests passed: 47/48\n\n1 test failed using input: \" or \"\"=\"")