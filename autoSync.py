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
    time.sleep(600)  # Wait for 10 min before checking again
    for root, dirs, files in os.walk(directory):
        if ".git" or ".obsidian/workspace.json" in root:
            continue
        for filename in files:
            path = os.path.join(root, filename)
            modified_time = os.path.getmtime(path)
            if modified_time != initial_times.get(path):
                print(f"{path} has been modified!")
                os.system(f'cd ..; git pull; git add *; git commit -m "autosync"; git push')
                initial_times[path] = modified_time
