# ObsidianUtilities

Specific utilities for transforming my notes to [obsidian](https://obsidian.md/)'s note-taking format.<br>
Plus automatic synchronization, which will pull changes from obsidian's github repository every 10min, and push changes made in local repository, if any, every 10min.

### Launch
Transform notes:
1. `make utils`
2. Go to localhost:8000 on browser.

Auto-sync:
1. This repository expects to sit inside root of obsidian repository.
2. `make sync`
