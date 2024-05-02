# ObsidianUtilities

Specific utilities for transforming my notes to [obsidian](https://obsidian.md/)'s note-taking format.<br>
Plus automatic synchronization, which will pull changes from obsidian's github repository every 10min, and push changes made in local repository, if any, every 10min.

### Launch
Transform notes:
1. `make utils`
2. Go to localhost:8000 on browser.

Auto-sync:
1. This 'ObsidianUtilities' repository expects to sit inside root of obsidian repository with obsidian repository containing an Obsidian folder where all the files lie without subfolders.
2. `make sync`
3. If wanting to specify time between synchronizations you can indicate it in seconds as a command like argument. For example `make sync time=10`.
