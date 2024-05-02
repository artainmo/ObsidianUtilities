import os
import time
import sys

directory = "../"
time_between_checks = int(sys.argv[1]) if len(sys.argv) == 2 else 600 # Wait for 10 min before checking again if no time specified in command line argument

# Store the initial file modification times
initial_times = {}
current_files = {}
for root, dirs, files in os.walk(directory):
    if root != "../Obsidian":
        continue
    for filename in files:
        path = os.path.join(root, filename)
        initial_times[path] = os.path.getmtime(path)
        current_files[path] = True # Remember all the files to verify if some got removed

# Continuously check for changes
while True:
    changes = False
    current_files = { file:False for file in current_files }
    os.system('cd ..; git pull')
    time.sleep(time_between_checks)
    for root, dirs, files in os.walk(directory):
        if root != "../Obsidian":
            continue
        for filename in files:
            path = os.path.join(root, filename)
            current_files[path] = True
            modified_time = os.path.getmtime(path)
            if modified_time != initial_times.get(path):
                # 'dict.get(unknownKey)' returns None when key is unknown while 'dict[unknownKey]' would create an execution error.
                # Thus new files are considered as modified files who need to be pushed.
                changes = True
                print(f"\033[1;32m'{path[3:]}' has been modified!\033[0m") if initial_times.get(path) != None else print(f"\033[0;32m'{path[3:]}' has been created!\033[0m")
                os.system(f'cd ..; git add "{path[3:]}"')
                initial_times[path] = modified_time
    for file, still_present in list(current_files.items()): # list() is used to create a copy of dictionnary allowing us to change it while looping over it
        if not still_present:
            print(f"\033[0;31m'{file[3:]}' has been removed!\033[0m")
            os.system(f'cd ..; git rm "{file[3:]}"')
            del current_files[file]
    if changes:
         os.system('cd ..; git pull; git commit -m "autosync"; git push')
    
