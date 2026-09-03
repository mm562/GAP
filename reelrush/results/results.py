import json
import csv 
import json
import glob

def csv_to_json(csvFilePath, jsonFilePath):
    jsonArray = []
      
    #read csv file
    with open(csvFilePath, encoding='utf-8') as csvf: 
        #load csv file data using csv library's dictionary reader
        csvReader = csv.DictReader(csvf) 

        #convert each csv row into python dict
        for row in csvReader: 
            #add this python dict to json array
            jsonArray.append(row)
  
    #convert python jsonArray to JSON String and write to file
    with open(jsonFilePath, 'w', encoding='utf-8') as jsonf: 
        jsonString = json.dumps(jsonArray, indent=4)
        jsonf.write(jsonString)
          
csv_files = glob.glob('surveyresults_test_raw.csv')

# Read each CSV file and append to list
for file in csv_files:
    
    json_file = file.replace("csv","json")
    csv_to_json(file, json_file)




with open('surveyresults_test_raw.json') as jf:
    d = json.load(jf)

Ed = d.items()
with open('surveyresults_test.csv', 'w') as outFile:
    outFile.write("studynr, userid, labelmode, aiamount, survey, question, answer\n")
    for item in Ed:

        studynr = item['studynr']
        userid = item['userid']
        labelmode = item['lab']
        aiamount = item['proc']
        survey = item['feedid']
        for key, value in item['result_data'].items():
            question = key
            print(question)
            answer = value
            print(value)
            str1 = studynr+", "+userid+", " +labelmode+", "+ aiamount+", "+survey+", "+question+", "+answer+"\n"
            print(str1)
            outFile.write(str1)
