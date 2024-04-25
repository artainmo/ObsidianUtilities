import os
import time

directory = "../"

# Store the initial file modification times
initial_times = {}
for root, dirs, files in os.walk(directory):
    if ".git" in root:
        continue
    for filename in files:
        path = os.path.join(root, filename)
        initial_times[path] = os.path.getmtime(path)

# Continuously check for changes
while True:
    changes = False
    os.system('cd ..; git pull')
    time.sleep(600)  # Wait for 10 min before checking again
    for root, dirs, files in os.walk(directory):
        if root != "../Obsidian":
            continue
        for filename in files:
            #print("   " + filename)
            path = os.path.join(root, filename)
            modified_time = os.path.getmtime(path)
            if modified_time != initial_times.get(path):
                changes = True
                print(f"'{path[3:]}' has been modified!")
                os.system(f'cd ..; git add "{path[3:]}"')
                initial_times[path] = modified_time
    if changes:
         os.system('cd ..; git pull; git commit -m "autosync"; git push')
    
