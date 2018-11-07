import json
from pprint import pprint

# Constants
db = {}
data1 = '1.json'
data2 = '2.json'
data3 = '3.json'
data4 = '4.json'




# Returns loaded json data from file
def load_json(file_path):
	with open(file_path) as f:
	    data = json.load(f)
	    return data

def add_to_db(data):
	for i in data:
		usernames = data[i].strip().split(" ")
		usernames = filter(None, usernames)
		for username in usernames:
			if username in db:
				db[username] += int(i)
			else:
				db[username] = int(i)

add_to_db(load_json(data1))
add_to_db(load_json(data2))
add_to_db(load_json(data3))

for key, value in sorted(db.iteritems(), key=lambda (k,v): (v,k)):
    print "%s" % (key)